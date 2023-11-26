<?php

namespace App\Console\Commands;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Database\Migrations\MigrationCreator;
use Illuminate\Support\Composer;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Migrations\BaseCommand;
use KitLoong\MigrationsGenerator\Enum\Migrations\Method\SchemaBuilder;
use KitLoong\MigrationsGenerator\Migration\Blueprint\SchemaBlueprint;
use KitLoong\MigrationsGenerator\Migration\Blueprint\TableBlueprint;
use KitLoong\MigrationsGenerator\Migration\Generator\ColumnGenerator;
use KitLoong\MigrationsGenerator\Schema\MySQLSchema;
use KitLoong\MigrationsGenerator\Schema\PgSQLSchema;
use KitLoong\MigrationsGenerator\Schema\SQLiteSchema;
use KitLoong\MigrationsGenerator\Schema\SQLSrvSchema;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use KitLoong\MigrationsGenerator\Enum\Driver;
use KitLoong\MigrationsGenerator\Schema\Schema;
use Illuminate\Support\Facades\DB;
use KitLoong\MigrationsGenerator\Migration\TableMigration;
use KitLoong\MigrationsGenerator\Setting;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema as FacadesSchema;
use Sven\ArtisanView\Generator;
use Sven\ArtisanView\Config as FsiConfig;
use Sven\ArtisanView\BlockStack;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;
use PHPHtmlParser\Dom;
use App\Models\SiteForm;
use App\Models\ContactForm;
use App\Models\FsiTask;
use App\Models\FsiTemplate;
use App\Models\FsiElement;
use App\Models\FsiReplacement;
use App\Models\FsiFormFieldReplacement;
use App\Models\FieldConfigData;

class FSIFormGenerateCommand extends BaseCommand implements PromptsForMissingInput
{
    protected $attrs = [];
    protected $signature = 'fsi:generate_form {name : The name of the migration}
    {--form_id= : Form id for which js page need to be created}
    {--form_name= : Form Name to generate the function name}
    {--form_key= : Form Key to append with API}
    {--domain_key= : Domain Key to append with API}
    {--extension=jsx}';
    protected $description = 'Description of your custom command';
    protected $schema;

    private $columnGenerator;
    protected $contactForm = [];
    protected $creator;
    private $db;
    private $options;
    private $modelPath;
    protected $composer;
    protected $tableMigration;
    protected $pageArr;
    protected $siteData = [];
    protected $fieldAttributes = [];
    protected $fsiElements = [];
    protected $fieldReplacements = [];
    protected $formName;
    protected $formKey;
    protected $replaceArray = [];
    protected $componentReplaceArray = [];
    protected $pageReplaceArray = [];
    protected $componentArgument;
    protected $componentParameter;
    protected $componentConstants;
    protected $isNameFieldChanged = false;
    protected $isEmailFieldChanged = false;
    protected $isNameFieldArray;
    public function __construct(Composer $composer, ColumnGenerator $columnGenerator, TableMigration $tableMigration)
    {
        $this->pageArr['imports'] = [];
        $this->pageArr['component_name'] = [];
        $this->pageArr['function_name'] = [];
        $this->pageArr['constants'] = [];

        $this->startTime = microtime(true);


        $this->modelPath = (app()->version() > '8')? app()->path('Models') : app()->path();

        $this->options = [
            'connection' => '',
            'namespace'  => '',
            'table'      => '',
            'schema'     => '',
            'folder'     => $this->modelPath,
            'filename'   => '',
            'debug'      => false,
            'singular'   => false,
            'overwrite'  => false
        ];
        parent::__construct();

        $this->creator = new MigrationCreator(app('files'), __DIR__.'/database/migrations');
        $this->columnGenerator     = $columnGenerator;
        $this->composer = $composer;
        $this->tableMigration      = $tableMigration;

    }


    public function handle()
    {
        $previousConnection = DB::getDefaultConnection();

        try {
            $this->setup($previousConnection);


        } catch(\Exception $e) {
            $this->error($e->getMessage());
        }
        $form_id = $this->input->getOption('form_id');
        if($form_id != null){
            $data = SiteForm::where('form_id', $form_id)->get()->toArray();
        } else {
            $this->siteData = $this->getSiteData();
            $data = SiteForm::where('site_id', $this->siteData['id'])->where('status', 0)->get()->toArray();
        }
        
        $this->componentParameter = $this->componentArgument ='';
        if(count($data)){
            $this->getFsiElements();
            $this->fieldAttributes = $this->getDbFormAttributes();
            $this->fieldReplacements = $this->getFsiFieldReplacements();

            $sitePages = [];
            foreach($data as $page){
                if(!isset($sitePages[$page['file_path']]))
                    $sitePages[$page['file_path']] = [];
                $sitePages[$page['file_path']][] = $page;
            }
            foreach($sitePages as $page_path => $data){
                $componentImports = [];
                foreach($data as $form){
                    $this->componentReplaceArray = $this->isNameFieldArray = [];
                    $this->isEmailFieldChanged = false; 
                    $this->isNameFieldChanged = false;
                    $this->componentParameter = $this->componentArgument ='';
                    $this->formName = "Fsi".str_replace(' ', '', $form['form_key']);
                    $this->formKey = $form['form_key'];
                    $this->contactForm = ContactForm::where('form_key', $form['form_key'])->get()->toArray();
                    if(count($this->contactForm)){
                        $this->contactForm = $this->contactForm[0];
                    }
                    $form_content = $this->getForm($form['form_content']);
                    $template = FsiTemplate::where('fsi_task_id', $form['fsi_task_id'])->firstOrFail()->toArray();
                    $constants = $this->getPageConstant();

                    $this->componentArgument = $this->getComponentArguments($form['fsi_task_id'], $template['id']);
                    $this->componentParameter = $this->getComponentParameters($form['fsi_task_id'], $template['id']);
                    $this->componentReplaceArray += $this->updateComponentConstants($template['template_path'], $this->componentParameter);
                    $componentImports[] = $this->getPageComponentImport($form['file_path']);
                    $this->componentReplaceArray += $this->getStubVariables($form_content, $template['template_path']);
                    $replaceArr = $this->updatePageConstants($form['file_path'], $constants);
                    $this->pageReplaceArray[$form['form_content']] = '<'.$this->formName.' '. $this->componentArgument . ' />';
                    $componentContent = $this->getStubContents(file_get_contents(base_path($template['template_path'])), $this->componentReplaceArray);
                    list($project_path, ) = explode('pages/',base_path($form['file_path']));
                    $componentPath = $project_path."components/".$this->formName.".jsx";
                    file_put_contents($componentPath, $componentContent);
                    $this->componentReplaceArray = [];
                }

                $imports = $this->getPageImport($componentImports, $form['file_path'], $form['fsi_task_id']);
                $this->pageReplaceArray += $replaceArr += $this->updatePageImports($form['file_path'], $imports);
                if(!$this->matchPageContent(file_get_contents(base_path($form['file_path'])), $imports)){
                    $pageContent = $this->getStubContents(file_get_contents(base_path($form['file_path'])), $this->pageReplaceArray);
                    file_put_contents(base_path($form['file_path']), $pageContent);
                }
                foreach($this->pageReplaceArray as $pkey => $pdata){
                    if(stristr($pkey, '<form')){
                        unset($this->pageReplaceArray[$pkey]);
                        $this->pageReplaceArray["form"] = $pdata;
                    }
                }
                $this->pageReplaceArray = [];
            }
        }    
        
    }


    protected function matchPageContent($content, $match_string){
         preg_match( '$'.$match_string.'$mis', $content, $matches);
         return count($matches);
    }
    protected function setup(string $connection): void
    {
        $setting = app(Setting::class);
        $setting->setDefaultConnection($connection);
        $setting->setUseDBCollation(false);
        $setting->setTableFilename(
            Config::get('migrations-generator.filename_pattern.table')
        );

        $setting->setViewFilename(
             Config::get('migrations-generator.filename_pattern.view')
        );

        $setting->setProcedureFilename(
             Config::get('migrations-generator.filename_pattern.procedure')
        );

        $setting->setFkFilename(
            Config::get('migrations-generator.filename_pattern.foreign_key')
        );

        $setting->setDate(
            Carbon::now()
        );

        $setting->setIgnoreIndexNames(false);
        $setting->setIgnoreForeignKeyNames(false);
        $setting->setSquash(false);
        $setting->setWithHasTable(false);

        $setting->setPath(
            Config::get('migrations-generator.migration_target_path')
        );
        $this->setStubPath($setting);

    }

    protected function setStubPath(Setting $setting): void
    {
        $defaultStub = Config::get('migrations-generator.migration_anonymous_template_path');



        $setting->setStubPath(
            $defaultStub
        );
    }
    private function getPath()
    {
        $paths = [];
        $fileName = $this->input->getArgument('name').'.'.$this->input->getOption('extension');
        foreach (glob(base_path()."/gitrepos/*/pages/".$fileName) as $migrationFileName) {
            if (File::exists($migrationFileName)) {
                File::delete($migrationFileName);    
            }
        }
        foreach(glob(base_path()."/gitrepos/*/pages") as $filePath)
            $paths[] = $filePath;
        return $paths;
    }

    private function getConfig()
    {
        return (new FsiConfig)
            ->setName($this->argument('name'))
            ->setExtension($this->option('extension'));
    }

    private function getPageComponentImport($filePath = ''){
        list(, $afterPages) = explode("pages/", $filePath);
        $countFolders = explode("/", $afterPages);
        $countFolders = array_map(fn($value): string => "../", $countFolders);
        $path = implode('', $countFolders);
        return 'import '.$this->formName.' from "'.$path.'components/'.$this->formName.'";';
    }

    public function checkImportClassFunctionExists($importArr, $keyList, $import){
        $keyExists = false;
        $keyArr = array_map('trim', explode(",", $keyList));
        $importKeyList = [];
        foreach($importArr as $importValue){
            foreach($keyArr as $key){
                if(stristr($importValue, $key.',') || stristr($importValue, $key.'}')){
                    $importKeyList[] = $key;
                } else if(stristr($importValue, $key)){
                    $importKeyList[] = $key;
                }
            }
        }

        if(count($importKeyList)){
            if(!count(array_diff($keyArr, $importKeyList))){
                $import = '';
            } else {
                $replace = implode(",", array_diff($keyArr,$importKeyList));
                $search = $keyList;
                $import = str_replace($search, $replace, $import);
            }
        }
        return $import;
    }
    private function getPageImport($componentImports, $filePath, $fsi_template_id){
        $importInFile = $this->getPageImports($filePath);
        $results = DB::select( DB::raw("SELECT if(is_import_type = 3, CONCAT('import ', ' \'', bname, '\';') ,CONCAT('import ', GROUP_CONCAT(cname), ' from \'', bname, '\';')) as import, bname, name, any_value(oname) oname from (SELECT if(c.is_import_type = 2, CONCAT('{',GROUP_CONCAT(c.name), '}'), GROUP_CONCAT(c.name)) cname, GROUP_CONCAT(c.name) oname, b.name bname, d.name, c.is_import_type FROM `jpage_imports` a, jpackages b, jpackage_imports c, jpages d, fsi_template_argument_list e WHERE a.jpage_id=d.id and a.jpackage_id = b.id and a.jpackage_import_id = c.id and b.id = c.jpackage_id and e.ref_id = a.jpackage_import_id and e.fsi_template_id = ".$fsi_template_id." GROUP by jpage_id, a.jpackage_id, c.is_import_type) ab group by bname, name, is_import_type") );
        $imports = [];
        foreach($results as $result){
            $import = $this->checkImportClassFunctionExists($importInFile, $result->oname, $result->import);
            if($import != '')
                $imports[] = $import;
        }

        foreach($componentImports as $result){
            $import = $this->checkImportClassFunctionExists($importInFile, $this->formName, $result);
            if($import != '')
                $imports[] = $result;
        }

        $imports = implode(PHP_EOL, $imports);
        return $imports;
    }

    private function getPageConstant(){
        $results = DB::select( DB::raw("SELECT replace(a.value, '[[constant_name]]', b.constant_name) constants FROM `fsi_template_argument_list` a, fsi_template_arguments b WHERE a.fsi_template_agrument_id = b.id and code_type = 'constant'") );
        $imports = [];
        foreach($results as $result){
            $imports[] = $result->constants;
        }
        $imports = implode(PHP_EOL, $imports).PHP_EOL;
        return $imports;
    }

    private function getSiteData(){
        $domain_key = $this->input->getOption('domain_key');

        $results = DB::select( DB::raw("SELECT * FROM `sites` WHERE domain_key = '$domain_key'") );
        $data = [];
        foreach($results as $result){
            $data = (array)$result;
        }
        return $data;
    }

    private function getDbFormAttributes(){
     
        $results = DB::select( DB::raw("SELECT concat(a.name, b.name) keyname, '' key_name, '' `value`, '' anyvalue FROM `fsi_elements` a, fsi_inputs b WHERE a.id = b.fsi_element_id and b.id not in (select `fsi_input_id` from fsi_element_attributes) UNION SELECT  concat(fe.name,fi.name) keyname, `key_name`, if(any_value(fea.attribute_type) = 'boolean' and any_value(fea.value) ='true', '', any_value(`value`) ) `value`, any_value(`attribute_type`) FROM  fsi_inputs fi, fsi_elements fe, fsi_element_attributes fea WHERE   fe.id = fi.fsi_element_id and fe.id = fea.fsi_element_id and fi.id = fea.fsi_input_id and (if(fea.attribute_type = 'boolean', if(fea.value ='true', 1, 0), 1)) group by fe.name, fi.name, fea.key_name") );
        $data = [];
        foreach($results as $result){
            $row = (array)$result;
            $key = $row['keyname'];
            if(!isset($data[$key]))
                $data[$key] = [];
            $data[$key][$row['key_name']] = $row['value'];
        }
        return $data;
    }


    function getForm($form) {
        $dom = new Dom;
        $dom->loadStr($form);
        $formObj = $dom->find('form');
        foreach($formObj as $key => $content){
            // get the class attr
            $class = $content->getAttributes();
            foreach($this->attrs as $attrKey => $attrValue){
                $info = ['value' => $attrValue];
                $content->setAttribute($attrKey, $attrValue);
            }
            $this->recursive_f($content);
        }
        $tagName = $formObj->tag->name();
        if(array_key_exists($tagName.$content->getAttribute('type'), $this->fieldAttributes)){
            foreach($this->fieldAttributes[$tagName.$content->getAttribute('type')] as $attrKey => $attrValue){
                $attrValue = $this->getStubContents($attrValue, $this->fieldReplacements);
                $content->setAttribute($attrKey, $attrValue, false, true);
            } 
        } else if(array_key_exists($tagName, $this->fieldAttributes)){
            foreach($this->fieldAttributes[$tagName] as $attrKey => $attrValue){
                $attrValue = $this->getStubContents($attrValue, $this->fieldReplacements);
                $content->setAttribute($attrKey, $attrValue, false, true);
            } 
        }
        return $formObj->outerHTML;
    }
    function getAttributes($attr){  
        preg_match_all('@(?:([a-zA-Z]+)="([^"]+)")+@m', $attr, $matches,PREG_SET_ORDER);
        $rArray=[];
        foreach($matches as $line):
            $rArray[$line[1]] =$line[2];   
        endforeach;
        $this->attrs += $rArray;
        return $rArray;
    }
    function getoAttributes($attr){  
        preg_match_all('@(?:([a-zA-Z]+)=({[^"]+}))+@m', $attr, $matches,PREG_SET_ORDER);
        $rArray=[];
        foreach($matches as $line):
            $rArray[$line[1]] =$line[2];   
        endforeach;
        $this->attrs += $rArray;
        return $rArray;
    }
    function barcode($string){    
        return preg_replace_callback(
            '@<form(.*)/?>@m',
            function($matches) {
                $this->getAttributes($matches[1]);
                $this->getoAttributes($matches[1]);
                //Here is where I process the array
                return '';
        },
        $string);
    }

    function recursive_f($content){
        $tagName = $content->tag->name();
        $nameArrtibute = $content->getAttribute('name');
        $field_id = md5($content->outerHTML);
        if($nameArrtibute == "name"){
            $this->isEmailFieldChanged = true;
        }
        if($nameArrtibute == "email"){
            $this->isEmailFieldChanged = true;
        }
        if($tagName == "select"){
            $nameArrtibute = 'fsi'.substr(md5($content->outerHTML), 0, 7);
            $content->setAttribute('name', $nameArrtibute , false, false);
            if(array_key_exists($tagName, $this->fieldAttributes)){
                $tmp = '';
                if(isset($this->fieldReplacements['[[name]]'])){
                    $tmp = $this->fieldReplacements['[[name]]'];
                    $this->fieldReplacements['[[name]]'] = $nameArrtibute;
                }

                foreach($this->fieldAttributes[$tagName] as $attrKey => $attrValue){
                    $attrValue = $this->getStubContents($attrValue, $this->fieldReplacements);
                    $content->setAttribute($attrKey, $attrValue, false, true);
                } 
                if($tmp != '')
                $this->fieldReplacements['[[name]]'] = $tmp;
            }
        }
        if($tagName == "textarea"){
            $content->setAttribute('name', "message" , false, false);
        }

        if($nameArrtibute == 'form_email'){
            if(!$this->isEmailFieldChanged){
                $nameArrtibute = 'email';
                $content->setAttribute('name', $nameArrtibute , false, false);
                $this->isEmailFieldChanged = true;
                $this->updateNameField($field_id, $content);
            }
        }

        if($nameArrtibute == 'form_name'){
            if(!$this->isNameFieldChanged){
                $nameArrtibute = 'name';
                $content->setAttribute('name', $nameArrtibute , false, false);
                $this->isNameFieldChanged = true;
                $this->updateNameField($field_id, $content);
            }
        }
         if($tagName == "button"){
            $content->removeAttribute('data-toggle');
            $content->removeAttribute('data-dismiss');
            $content->removeAttribute('data-target');
            $content->setAttribute('type', 'submit', false, false);
         }
        if($tagName != "PhoneInput" && $tagName != 'text' && $content->hasChildren()){
            $childs = $content->getChildren();
            foreach($childs as $key => $child){
                $class = $child->getAttributes();
                $this->recursive_f($child);
    
            }
        } else {
            if( in_array($tagName, $this->fsiElements)){
                $content->tag->parseAttributes($content->outerHTML, $content->tag->name());
                $nameArrtibute = $content->getAttribute('name');
                if($nameArrtibute == 'form_email' && !$this->isEmailFieldChanged){
                    $nameArrtibute = 'email';
                    $this->isEmailFieldChanged = true;
                    $this->updateNameField($field_id, $content);
                }
                if($nameArrtibute == 'form_name' && !$this->isNameFieldChanged){
                    $nameArrtibute = 'name';
                    $this->isNameFieldChanged = true;
                    $this->updateNameField($field_id, $content);
                }
                if($tagName == "PhoneInput" && $nameArrtibute == ''){
                    $nameArrtibute = 'mobile';
                }
                if($nameArrtibute == ''){
                    $nameArrtibute = 'fsi'.substr(md5($content->outerHTML), 0, 7);
                }
                $nameArrtibute = str_replace(['-',' '], '', $nameArrtibute);
                if(isset( $this->fieldReplacements['[[name]]'])){
                    $this->fieldReplacements['[[name]]'] = $nameArrtibute;
                }
                
                $content->setAttribute('name', $nameArrtibute, false, false);
                if(array_key_exists($tagName.$content->getAttribute('type'), $this->fieldAttributes)){
                    foreach($this->fieldAttributes[$tagName.$content->getAttribute('type')] as $attrKey => $attrValue){
                        $attrValue = $this->getStubContents($attrValue, $this->fieldReplacements);
                        $content->setAttribute($attrKey, $attrValue, false, true);
                    } 
                } else if(array_key_exists($tagName, $this->fieldAttributes)){
                    foreach($this->fieldAttributes[$tagName] as $attrKey => $attrValue){
                        $attrValue = $this->getStubContents($attrValue, $this->fieldReplacements);
                        $content->setAttribute($attrKey, $attrValue, false, true);
                    } 
                }
            }
        }
        return;
    }

    public function updateNameField($field_id, $content){
        if(isset($this->contactForm['id']) && $content->getAttribute('name') != ''){
            FieldConfigData::where('field_id',$field_id)->where('contact_form_id',$this->contactForm['id'])->update(['field_name' => $content->getAttribute('name'), 'real_name' => $content->getAttribute('name')]);
        }
    }

    public function getStubVariables($form_content, $template){
        $contents = file_get_contents(base_path($template));
        preg_match_all('/\[\[(.*?)\]\]/i', $contents, $regs, PREG_PATTERN_ORDER);
        $replaceArr = [];
        $form_content = str_replace('</form>', '
        <div className="form-group">
        { (isVerified) && 
                                <ReCAPTCHA
                    sitekey={vidyKey?.key}
                    ref={recaptchaRef}
                    onChange={handleCaptchaSubmission}
                    size="invisible"
                  />}
        </div>
        </form>', $form_content);
        for ($i = 0; $i < count($regs[0]); $i++) {
            if(stristr($regs[0][$i], '[[form]]')){
                $replaceArr[$regs[0][$i]] = $form_content;
            } else if(stristr($regs[0][$i], '[[componentName]]')){
                $replaceArr[$regs[0][$i]] = $this->formName;
            } else {
                $replaceArr[$regs[0][$i]] = '';
            }
        }


        
        return $replaceArr;
    }

    
    public function updateComponentConstants($template, $constants){
        $contents = file_get_contents(base_path($template));
        preg_match('/const(.*(\(.*\))\ \=\>\ \{)/im', $contents, $regs);
            $replaceArr = [];
            for ($i = 0; $i < count($regs); $i++) {
                if(stristr($regs[$i], '[[form]]')){
                    $replaceArr[$regs[$i]] = $form_content;
                } else if(stristr($regs[$i], '[[componentName]]')){
                    $tempContent = str_replace('()', '('.$this->componentParameter.')', $regs[$i]);
                    $replaceArr[$regs[$i]] = str_replace('[[componentName]]', $this->formName, $tempContent) . PHP_EOL;
                } else {
                    $replaceArr[$regs[$i]] = '';
                }
                break;
            }
        return $replaceArr;
    }


    public function updateImports($template, $imports){
        $contents = file_get_contents(base_path($template));
        preg_match_all('/import(.*)/i', $contents, $regs, PREG_PATTERN_ORDER);
        $replaceArr = [];
        $replaceArr[$regs[0][count($regs[0])-1]] = $regs[0][count($regs[0])-1] . PHP_EOL . $imports;
        return $replaceArr;
    }


    public function updatePageConstants($template, $constants){
        $contents = file_get_contents(base_path($template));
        preg_match('/const(.*(\(.*\))\ \=\>\ \{)/im', $contents, $regs);
            $replaceArr = [];
            for ($i = 0; $i < count($regs); $i++) {
                $replaceArr[$regs[$i]] = $regs[$i] . PHP_EOL . $constants;
                break;
            }
        return $replaceArr;
    }


    public function getPageImports($template){
        $contents = file_get_contents(base_path($template));
        preg_match_all('/import(.*);/i', $contents, $regs, PREG_PATTERN_ORDER);
        return $regs[0];
    }

    public function updatePageImports($template, $imports){
        $contents = file_get_contents(base_path($template));
        preg_match_all('/import(.*);/i', $contents, $regs, PREG_PATTERN_ORDER);
        $replaceArr = [];
        $replaceArr[$regs[0][count($regs[0])-1]] = $regs[0][count($regs[0])-1] . PHP_EOL . $imports;
        return $replaceArr;
    }

    public function updatePageComponent($template, $imports){
        $contents = file_get_contents(base_path($template));
        preg_match_all('/import(.*)/i', $contents, $regs, PREG_PATTERN_ORDER);
        $replaceArr = [];
        $replaceArr[$regs[0][count($regs[0])-1]] = $regs[0][count($regs[0])-1] . PHP_EOL . $imports;
        return $replaceArr;
    }

    private function getFsiElements(){

        $this->fsiElements = FsiElement::all()->pluck('name', 'id')->toArray();

        
    }
    private function getFsiFieldReplacements(){
 
        $data = FsiReplacement::all()->pluck('replace_name', 'search_name')->toArray();
        $dataArr = [];
        foreach($data as $key => $value){
            $dataArr['[['.$key.']]'] = $value;
        }
        return $dataArr;
    }

    public function getStubContents($contents , $stubVariables = [])
    {
        if(isset($stubVariables['[[form_key]]']))
            $stubVariables['[[form_key]]'] = $this->formKey;

        $contents = str_replace(array_keys($stubVariables) , $stubVariables, $contents);
        return $contents;

    }

    public function getStubPath($filePath)
    {
        return base_path('contact_forms/stubs/views/nextjs/'.$filePath);
    }

    public function getComponentArguments($task_id, $template_id){
        $form_id = $this->input->getOption('form_id');
        $results = DB::select( DB::raw("SELECT GROUP_CONCAT(parameters SEPARATOR ' ') arguments FROM (SELECT if(value_type_id =2, concat(`key_name`, ' = {', `value`,'}'), concat(`key_name`, ' = \"', `value`,'\"')) parameters, 1 as id FROM `fsi_template_arguments`  WHERE fsi_template_id = '$template_id') a group by id") );
        $arguments = "";
        foreach($results as $result){
            $arguments = $result->arguments;
        }
        return $arguments;

    }


    public function getComponentParameters($task_id, $template_id){
        $form_id = $this->input->getOption('form_id');
        $results = DB::select( DB::raw("SELECT CONCAT('{',GROUP_CONCAT(parameters SEPARATOR ', '), '}') arguments FROM (SELECT key_name parameters, 1 as id FROM `fsi_template_arguments` WHERE fsi_template_id = '$template_id') a group by id") );
        $arguments = "";
        foreach($results as $result){
            $arguments = $result->arguments;
        }
        return $arguments;

    }

    public function _generateModelTable($domain_key, $form_key)
    {
        $tableName = "contact_forms_{$domain_key}_{$form_key}";
        $migrationPath = database_path('migrations');
        $migrationFilePath = glob($migrationPath . DIRECTORY_SEPARATOR . '*'.$tableName . '*.php');
        foreach (glob($migrationPath . DIRECTORY_SEPARATOR . '*'.$tableName . '*.php') as $migrationFileName) {
            if (File::exists($migrationFileName)) {
                File::delete($migrationFileName);    
            }
        }
        // Run the "migrate" Artisan command
        Artisan::call('custom:command', ['name'=> 'test', '--table'=> 'test', '--domain_key'=>$domain_key, '--form_key'=>$form_key]);
        
        Artisan::call('generate:modelfromtable', ['--table'=> $tableName]);
       
    
        // Capture the output of the command
        $output = Artisan::output();
        // Do something with the output (e.g., display it or log it)
        //return view('command-output', ['output' => $output]);
    }
}





//SELECT if(c.is_import_type = 2, CONCAT('{',GROUP_CONCAT(c.name), '}'), GROUP_CONCAT(c.name)), b.name, c.is_class, c.is_function, c.is_file, d.name FROM `jpage_imports` a, jpackages b, jpackage_imports c, jpages d WHERE a.jpage_id=d.id and a.jpackage_id = b.id and a.jpackage_import_id = c.id and b.id = c.jpackage_id GROUP by jpage_id, a.jpackage_id, c.is_import_type;

// SELECT CONCAT('import ', GROUP_CONCAT(cname), ' from \'', bname, '\';'), bname, name from (SELECT if(c.is_import_type = 2, CONCAT('{',GROUP_CONCAT(c.name), '}'), GROUP_CONCAT(c.name)) cname, b.name bname, c.is_class, c.is_function, c.is_file, d.name FROM `jpage_imports` a, jpackages b, jpackage_imports c, jpages d WHERE a.jpage_id=d.id and a.jpackage_id = b.id and a.jpackage_import_id = c.id and b.id = c.jpackage_id GROUP by jpage_id, a.jpackage_id, c.is_import_type) ab group by bname, name;

//SELECT if(is_import_type = 3, CONCAT('import ', ' \'', bname, '\';') ,CONCAT('import ', GROUP_CONCAT(cname), ' from \'', bname, '\';')), bname, name from (SELECT if(c.is_import_type = 2, CONCAT('{',GROUP_CONCAT(c.name), '}'), GROUP_CONCAT(c.name)) cname, b.name bname, c.is_class, c.is_function, c.is_file, d.name, c.is_import_type FROM `jpage_imports` a, jpackages b, jpackage_imports c, jpages d WHERE a.jpage_id=d.id and a.jpackage_id = b.id and a.jpackage_import_id = c.id and b.id = c.jpackage_id GROUP by jpage_id, a.jpackage_id, c.is_import_type) ab group by bname, name;


// recaptcha field 
// field type -> api, display
// api -> url, type, response type, request method,response key
// tag and attributes
//  attribute -> key value pair
        // value -> string, integer, function name, variable
        // function -> return, arguments, 
// constants
// method
// api
