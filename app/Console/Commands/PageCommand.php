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


class PageCommand extends BaseCommand implements PromptsForMissingInput
{
    protected $attrs = [];
    protected $signature = 'fsi:page {name : The name of the migration}
    {--form_id= : Form id for which js page need to be created}
    {--form_name= : Form Name to generate the function name}
    {--form_key= : Form Key to append with API}
    {--domain_key= : Domain Key to append with API}
    {--extension=jsx}';
    protected $description = 'Description of your custom command';
    protected $schema;

    private $columnGenerator;

    protected $creator;
    private $db;
    private $options;
    private $modelPath;
    protected $composer;
    protected $tableMigration;


    public function __construct(Composer $composer, ColumnGenerator $columnGenerator, TableMigration $tableMigration)
    {
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
        

        // It's possible for the developer to specify the tables to modify in this
        // schema operation. The developer may also specify if this table needs
        // to be freshly created so we can create the appropriate migrations.
        $name = Str::snake(trim($this->input->getArgument('name')));
        $this->db = DB::connection($this->options['connection']);
        $pageData = $this->getPage();
        $paths = $this->getPath();
        $siteData= $this->getSiteData();
        $process = new Process(['vendor/bin/phing', ' -DprojectType='.$siteData['project_type'].' -Dgitrepo='.$siteData['git_url'].' -DprojectName='.$this->input->getOption('domain_key')]);
        $output = $process->run();
        $fileName = 'CallbackForm.'.$this->input->getOption('extension');

        foreach (glob(base_path()."/projects/".$this->input->getOption('domain_key')."/components/".$fileName) as $migrationFileName) {
            if(!stristr($migrationFileName, '_')){
                $content = file_get_contents($migrationFileName);
                $form = $this->getTextBetweenTags($content, 'form');
            }
        }
        $this->info("Phing execution: $output");
        foreach($paths as $path){
            $generator = new Generator($this->getConfig(), $path);
            $generator->generate(
                (new BlockStack)->build($this->input, $path)
            );
            $this->info("Created: $path");
        }
        
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

    private function getPage(){
        $form_id = $this->input->getOption('form_id');
        $results = DB::select( DB::raw("SELECT if(is_import_type = 3, CONCAT('import ', ' \'', bname, '\';') ,CONCAT('import ', GROUP_CONCAT(cname), ' from \'', bname, '\';')) as import, bname, name from (SELECT if(c.is_import_type = 2, CONCAT('{',GROUP_CONCAT(c.name), '}'), GROUP_CONCAT(c.name)) cname, b.name bname, d.name, c.is_import_type FROM `jpage_imports` a, jpackages b, jpackage_imports c, jpages d WHERE a.jpage_id=d.id and a.jpackage_id = b.id and a.jpackage_import_id = c.id and b.id = c.jpackage_id and d.contact_form_id = '$form_id' GROUP by jpage_id, a.jpackage_id, c.is_import_type) ab group by bname, name, is_import_type") );
        $imports = [];
        foreach($results as $result){
            $imports[] = $result->import;
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

    function getTextBetweenTags($string, $tagname) {
        $startPoint = stripos($string, '<'.$tagname) ;
        $endMatch =  stripos($string, '</'.$tagname) ;
        $endLength = $endMatch + strlen('</'.$tagname)+1 - $startPoint;
        $match = substr($string, stripos($string, '<'.$tagname), $endLength);

$htmlContent = 'dvs
<div class="my-con">
Content goes here...</div>nmnbm
';

preg_match('/<form[^>]*>(.*?)<\/form>/sim', $string, $matches);
$form = $matches[0];
print_r($matches);
preg_match_all('/\<(\w+)(?:\s*|\>)?/si', $form, $match);
$this->barcode($form);
//print_r($this->attrs);
$dom = new Dom;
$dom->loadStr($form);
$formObj = $dom->find('form');
foreach($formObj as $key => $content){
	// get the class attr
	$class = $content->getAttributes();
    $content->tag->name()."\n";
    foreach($this->attrs as $attrKey => $attrValue){
        $info = ['value' => $attrValue];
        $content->setAttribute($attrKey, $attrValue);
    }
    
    recursive_f($content);
	//echo $content->name;
	// do something with the html
	$html = $content->outerHtml;

	// or refine the find some more
	$child   = $content->firstChild();
	$sibling = $child->nextSibling();
}

        return $match;
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
    function barcode($file){    
        return preg_replace_callback(
            '@<form(.*)/?>@m',
            function($matches) {
                $this->getAttributes($matches[1]);
                $this->getoAttributes($matches[1]);
                //Here is where I process the array
                return '';
        },
        $file);
    }
}




function recursive_f($content){
    $tagName = $content->tag->name();
    if($tagName != 'text')
    if($content->hasChildren()){
        $childs = $content->getChildren();
        foreach($childs as $key => $child){
            $class = $child->getAttributes();
            recursive_f($child);

        }
    } else {
        $content->tag->parseAttributes($content->outerHTML, $content->tag->name());
    }
    return;
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
