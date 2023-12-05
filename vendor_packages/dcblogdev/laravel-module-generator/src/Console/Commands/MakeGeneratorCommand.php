<?php

namespace Dcblogdev\ModuleGenerator\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use RuntimeException;
use Symfony\Component\Filesystem\Filesystem as SymfonyFilesystem;
use Symfony\Component\Finder\Finder;
use App\Models\FsiTableField;
use App\Models\FsiTable;
class MakeGeneratorCommand extends Command
{
    protected       $signature   = 'module:build {name : The name of the module}';
    protected $tableInfo;
    protected       $description = 'Create starter module from a template';
    protected array $caseTypes   = [
        'module' => 'strtolower',
        'Module' => 'ucwords',
        'model'  => 'strtolower',
        'Model'  => 'ucwords',
    ];
    protected $migrationArray = []; 
    protected $fieldHtml = [];
    protected $implodeSeparatorArr = ['Model' => "','"];
    public function handle(): bool
    {
        $this->container['name'] = implode('', array_map('ucwords', explode('_', $this->input->getArgument('name'))));
        if ($this->container['name'] === '') {
            $this->error("\nName cannot be empty.");

            return $this->handle();
        }

        if (file_exists(base_path('Modules/' . $this->container['name']))) {
           // $this->error("\nModule already exists.");
           \File::deleteDirectory(base_path('Modules/' . $this->container['name']));
           // return true;
        }
        $tableData = FsiTable::where('name', $this->input->getArgument('name'))->get()->toArray();
        if(count($tableData)){
            $this->tableInfo = $tableData[0];
        }
        $this->container['folder'] = config('module-generator.path');
        if (! file_exists(base_path($this->container['folder']))) {
            $this->error("\nPath does not exist.");

            return true;
        }

        $this->generate();

        $this->info('Starter ' . $this->container['name'] . ' module generated successfully.');

        return true;
    }

    protected function generate(): void
    {
        //ensure directory does not exist
        $this->delete(base_path('generator-temp'));

        $folder = $this->container['folder'];
        $this->copy(base_path($folder), base_path('generator-temp'));
        $folderPath = base_path('generator-temp');

        $finder = new Finder();
        $finder->files()->in($folderPath);

        $this->renameFiles($finder);
        $this->fieldHtml = [];
        $this->fieldsUpdate($finder);
        $this->updateFilesContent($finder);
        //print_r($this->fieldHtml);
        $this->fieldHtml = [];
        $this->copy($folderPath, './Modules');
        $this->delete('./Modules/Module');
        $this->delete($folderPath);
    }

    public function delete($sourceFile): void
    {
        $filesystem = new SymfonyFilesystem;
        if ($filesystem->exists($sourceFile)) {
            $filesystem->remove($sourceFile);
        }
    }

    protected function copy($sourceFile, $target): void
    {
        $filesystem = new SymfonyFilesystem;
        if ($filesystem->exists($sourceFile)) {
            $filesystem->mirror($sourceFile, $target);
        }
    }

    protected function renameFiles($finder): void
    {
        foreach ($finder as $file) {
            $type       = Str::endsWith($file->getPath(), ['migrations', 'Migrations']) ? 'migration' : '';
            $sourceFile = $file->getPath() . '/' . $file->getFilename();
            $this->alterFilename($sourceFile, $type);
        }
    }

    protected function alterFilename($sourceFile, $type = ''): void
    {
        if(stristr($sourceFile, 'fields/')){
            return ;
        }
        $name  = ucwords($this->container['name']);
        $model = Str::singular($name);

        $targetFile = $sourceFile;
        $targetFile = str_replace(
            ['Module', 'module', 'Model', 'model'],
            [$name, strtolower($name), $model, strtolower($model)],
            $targetFile
        );
        $this->migrationArray[basename($targetFile, '.php')] = basename($sourceFile, '.php');

        if (in_array(basename($sourceFile), config('module-generator.ignore_files'), true)) {
            $targetFile = dirname($targetFile) . '/' . basename($sourceFile);
        }

        //hack to ensure Models exists
        $targetFile = str_replace("Entities", "Models", $targetFile);

        //hack to ensure modules if used does not get replaced
        if (Str::contains($targetFile, $name . 's')) {
            $targetFile = str_replace($name . 's', "Modules", $targetFile);
        }

        if (
            ! is_dir(dirname($targetFile))
            && ! mkdir($concurrentDirectory = dirname($targetFile), 0777, true) && ! is_dir($concurrentDirectory)
        ) {
            throw new RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
        }

        $this->rename($sourceFile, $targetFile, $type);
    }

    protected function rename($sourceFile, $targetFile, $type = ''): void
    {
        $filesystem = new SymfonyFilesystem;
        if ($filesystem->exists($sourceFile)) {
            if ($type === 'migration') {
                $targetFile = $this->appendTimestamp($targetFile);
                $this->migrationArray[basename($targetFile, '.php')] = basename($sourceFile, '.php');
            }
            $filesystem->rename($sourceFile, $targetFile, true);
        }
    }

    protected function appendTimestamp($sourceFile): array|string
    {
        $timestamp = date('Y_m_d_his_');
        $file      = basename($sourceFile);

        return str_replace($file, $timestamp . $file, $sourceFile);
    }

    protected function updateFilesContent($finder): void
    {
        foreach ($finder as $file) {
            $sourceFile = $file->getPath() . '/' . $file->getFilename();
            $this->replaceInFile($sourceFile);
        }
    }

    protected function replaceInFile($sourceFile): void
    {
        if(stristr($sourceFile, 'fields/')){
            return ;
        }

        $name  = ucwords($this->container['name']);
        $model = Str::singular($name);
        $types = [
            '{Module_}' => $this->renamePlaceholders($name, '_'),
            '{module_}' => $this->renamePlaceholders($name, '_', arrayMap: true),
            '{module-}' => $this->renamePlaceholders($name, '-', arrayMap: true),
            '{Module-}' => $this->renamePlaceholders($name, '-'),
            '{Module}'  => $name,
            '{ModuleText}'  => implode(' ', array_map('ucwords', explode('_', $this->input->getArgument('name')))),
            '{Module }' => trim(preg_replace('/(?<!\ )[A-Z]/', ' $0', $name)),
            '{module}'  => strtolower($this->input->getArgument('name')),
            '{module }' => trim(preg_replace('/(?<!\ )[A-Z]/', ' $0', strtolower($name))),
            '{Model-}'  => $this->renamePlaceholders($model, '-'),
            '{model-}'  => $this->renamePlaceholders($model, '-', arrayMap: true),
            '{Model_}'  => $this->renamePlaceholders($model, '_'),
            '{model_}'  => $this->renamePlaceholders($model, '_', arrayMap: true),
            '{Model}'   => $model,
            '{ModelText}'   => implode(' ', array_map('ucwords', explode('_', Str::singular($this->input->getArgument('name'))))),
            '{model}'   => strtolower($model),
            '{model }'  => trim(preg_replace('/(?<!\ )[A-Z]/', ' $0', strtolower($model))),
        ];
        $fileBaseName = '';
        $originalFileBaseName = '';
        if(stristr($sourceFile, '.blade.php'))
            $fileBaseName = basename($sourceFile, '.blade.php');
        else if(stristr($sourceFile, '.php'))
            $fileBaseName = basename($sourceFile, '.php');
        if(isset($this->migrationArray[$fileBaseName])){
            $originalFileBaseName = $fileBaseName;
            $fileBaseName = $this->migrationArray[$fileBaseName];
        }

        if(isset($this->fieldHtml[$fileBaseName])){
            if(isset($this->implodeSeparatorArr[$fileBaseName])){
                foreach($this->fieldHtml[$fileBaseName] as $fileKey => $fieldHtml){
                    $types['{'.$fileKey.'}'] = implode($this->implodeSeparatorArr[$fileBaseName], $fieldHtml);
                    $types['{field_count}'] = count($fieldHtml);
                }
            } else {
                foreach($this->fieldHtml[$fileBaseName] as $fileKey => $fieldHtml){
                    $types['{'.$fileKey.'}'] = implode(PHP_EOL, $fieldHtml);
                    $types['{field_count}'] = count($fieldHtml);
                }
            }
        }
        //$types += $this->fieldHtml;

        foreach ($types as $key => $value) {
            if (file_exists($sourceFile)) {
                file_put_contents($sourceFile, str_replace($key, $value, file_get_contents($sourceFile)));
            }
        }
    }

    protected function renamePlaceholders($model, $separator, $arrayMap = null): string
    {
        $parts = preg_split('/(?=[A-Z])/', $model, -1, PREG_SPLIT_NO_EMPTY);

        if ($arrayMap) {
            $parts = array_map('strtolower', $parts);
        }

        return implode($separator, $parts);
    }

    public function append($sourceFile, $content): void
    {
        $filesystem = new SymfonyFilesystem;
        if ($filesystem->exists($sourceFile)) {
            $filesystem->appendToFile($sourceFile, $content);
        }
    }

    public function fieldsUpdate($finder){
        
        foreach ($finder as $file) {
            $tableFieldData = [];
            $sourceFile = $file->getPath() . '/' . $file->getFilename();
            if(stristr($sourceFile, 'fields/')){ 
                if(stristr($sourceFile, '.blade.php'))          
                    $fieldsFileNameList = explode('-',basename($sourceFile, '.blade.php'));
                else if(stristr($sourceFile, '.php'))          
                    $fieldsFileNameList = explode('-',basename($sourceFile, '.php'));
            
                $fileBaseName = $fieldsFileNameList[0];
                if(!isset($this->fieldHtml[$fileBaseName])){
                    $this->fieldHtml[$fileBaseName] = [];
                }
                unset($fieldsFileNameList[0]);
                $this->fieldHtml[$fileBaseName][implode('-', $fieldsFileNameList)] = []; 
                $tableFieldData = FsiTableField::where('fsi_table_id', $this->tableInfo['id'])->orderBy('weight', 'asc')->get()->toArray();
                foreach($tableFieldData as $fieldData){
                    $this->replaceFieldsInFile($sourceFile, $fieldData, $this->fieldHtml[$fileBaseName][implode('-', $fieldsFileNameList)]);
                }

            }
            //$this->replaceInFile($sourceFile);
        }
    }

    protected function replaceFieldsInFile($sourceFile, $fieldData, &$fieldHtml): void
    {
        $name  = ucwords($this->container['name']);
        $model = Str::singular($name);
        extract($fieldData);
        $types = [
            '{Module_}' => $this->renamePlaceholders($name, '_'),
            '{module_}' => $this->renamePlaceholders($name, '_', arrayMap: true),
            '{module-}' => $this->renamePlaceholders($name, '-', arrayMap: true),
            '{Module-}' => $this->renamePlaceholders($name, '-'),
            '{Module}'  => $name,
            '{Module }' => trim(preg_replace('/(?<!\ )[A-Z]/', ' $0', $name)),
            '{module}'  => strtolower($name),
            '{module }' => trim(preg_replace('/(?<!\ )[A-Z]/', ' $0', strtolower($name))),
            '{Model-}'  => $this->renamePlaceholders($model, '-'),
            '{model-}'  => $this->renamePlaceholders($model, '-', arrayMap: true),
            '{Model_}'  => $this->renamePlaceholders($model, '_'),
            '{model_}'  => $this->renamePlaceholders($model, '_', arrayMap: true),
            '{Model}'   => $model,
            '{model}'   => strtolower($model),
            '{display_name}'   => $field_display_name,
            '{field_name}'   => $field_name,
            '{model }'  => trim(preg_replace('/(?<!\ )[A-Z]/', ' $0', strtolower($model))),
        ];
        foreach($fieldData as $fieldKey => $fieldValue){
            if(!isset($types['{'.$fieldKey.'}'])){
                $types['{'.$fieldKey.'}'] = $fieldValue;
            }
        }

        if (file_exists($sourceFile)) {

            if(count($fieldHtml))
                $fieldHtml[] = str_replace(array_keys($types), $types, file_get_contents($sourceFile));
            else 
            $fieldHtml[] = trim(str_replace(array_keys($types), $types, file_get_contents($sourceFile)));

        } else {
        }
    }
}
