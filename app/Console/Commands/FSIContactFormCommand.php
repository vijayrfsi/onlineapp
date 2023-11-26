<?php
 
namespace App\Console\Commands;
 
use App\Models\FsiElement;
use App\Models\FsiReplacement;
use App\Models\FsiFormFieldReplacement;
use App\Models\SiteForm;
use App\Models\SiteFormField;
use App\Models\Site;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use PHPHtmlParser\Dom;
class FSIContactFormCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $field_counter = 0;
    protected $signature = 'fsi:get_forms {name}
    {--domain_key= : Domain Key to append with API}
    {--extension=jsx}';
 
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a marketing email to a user';

    protected $filePath = '';
    protected $siteFormFieldData = [];

    protected $siteData = [];

    protected $fsiElements = [];
    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->siteData = $this->getSiteData();

        if($this->siteData['git_url'] != ''){
            
            $process = new Process(['vendor/bin/phing','build', '-DprojectType='.$this->siteData['project_type'], '-Dgitrepo='.$this->siteData['git_url'], '-DprojectName='.$this->input->getOption('domain_key'), '-verbose']);
            $process->setTimeout(240);
            $process->run();

            foreach ($process as $type => $data) {
                if ($process::OUT === $type) {
                    info($data);    //output store in log file..
                    $this->info($data);  //show output in console..
                    //       $this->info(print_r($data,true)) // if output is array or object then used
                } else {
                    $this->warn("error :- ".$data);
                    shell_exec("/bin/sh phing.sh build ". base_path().' '.$this->siteData['project_type'].' '.$this->siteData['git_url']. ' '.$this->input->getOption('domain_key'));
                }
            }
    
            //$this->info("get output");
        }
        $fileName = '*.'.$this->input->getOption('extension');
        $this->getFsiElements();
        $files = glob(base_path()."/projects/".$this->siteData['domain_key']."/pages/**");
        $files = array_merge($files,glob(base_path()."/projects/".$this->siteData['domain_key']."/pages/**/**"));
        foreach ($files  as $migrationFileName) {
            if(!stristr($migrationFileName, '_app.jsx') && !stristr($migrationFileName, '_document.jsx') && stristr($migrationFileName, '.jsx')){
                $this->filePath = $migrationFileName;
                $content = file_get_contents($migrationFileName);
                $fileName = basename($migrationFileName, '.'.$this->input->getOption('extension'));

                $forms = $this->getTextBetweenTags($content, 'form', $fileName, $this->siteData['id']);
                if(count($forms)){
                    $siteForms = SiteForm::where('site_id', $this->siteData['id'])->where('page_name', $fileName)->get()->pluck('id', 'id')->toArray();
                    SiteFormField::whereIn('site_form_id', $siteForms)->delete();

                    foreach(SiteForm::where('site_id', $this->siteData['id'])->where('page_name', $fileName)->get() as $delete){
                        $delete->delete();
                    }

                    foreach ($forms as $key => $form) {
                        $form_content = $form['form_content'];
                        $siteFormExists = SiteForm::where('form_key', '=', $form['form_key'])->get();
                        //if(!$siteFormExists->count()){
                            $insert = SiteForm::create($form);
                        //}
                        $dom = new Dom;
                        $dom->loadStr($form_content);
                        $formObj = $dom->find('form');
                        $this->field_counter = 0;
                        foreach($formObj as $key => $content){
                            $this->siteFormFieldData = [];
                            $this->recursive_f($content, $insert->id, $insert->form_key);
                            foreach($this->siteFormFieldData as $formField){
                                $insert = SiteFormField::create($formField);
                            }
                                
                        }
                    }
                }
            }
        }
    }

    private function getSiteData(){
        $domain_key = $this->input->getOption('domain_key');

        $results = Site::where('domain_key', $domain_key)->get()->toArray();
        $data = [];
        foreach($results as $result){
            $data = $result;
        }
        return $data;
    }

    private function getFsiElements(){

        $this->fsiElements = FsiElement::all()->pluck('name', 'id')->toArray();
        
    }

    function getTextBetweenTags($string, $tagname, $fileName, $site_id) {

        preg_match_all('/<'.$tagname.'[^>]*>(.*?)<\/'.$tagname.'>/sim', $string, $forms);
        $formList = [];
        if(count($forms[0]) > 0){
            foreach($forms[0] as $key => $form){
                $eachForm = [];
                $eachForm['form_id'] = md5($form); 
                $eachForm['site_id'] = $site_id; 
                $eachForm['fsi_task_id'] = 2; 
                $eachForm['form_content'] = $form; 
                $eachForm['page_name'] = $fileName; 
                $eachForm['file_path'] = str_replace(base_path(), '', $this->filePath); 
                $eachForm['form_name'] = $this->getFormAttibutes($form); 
                $eachForm['form_key'] = $this->getFormAttibutes($form, 'key'); 
                $formList[] = $eachForm;
            }
            
        }
        return $formList;
    }

    function getFormAttibutes($form, $attributeName = 'id') {

        $dom = new Dom;
        $dom->loadStr($form);
        $formObj = $dom->find('form');
        $attributes = $formObj->getAttributes();  
        if($attributeName == 'key')
            return substr(md5($formObj->outerHTML), 0,9);
        if(!isset($attributes[$attributeName])){
            $attributeName = 'name';
        }
        if(isset($attributes[$attributeName])){
            if($attributes[$attributeName] != ''){
                $list = explode('-', $attributes[$attributeName]);
                $list = array_map('ucfirst', $list);
                return implode(' ', $list);
            } else {
                return $attributes[$attributeName];
            }
        } else {
            return substr(md5(md5($formObj->innerHTML)), 0,9);
        }
    }

    private function getDbFormAttributes(){
        $this->siteData;
        $form_id = $this->input->getOption('form_id');
        $results = DB::select( DB::raw("SELECT * FROM `sites` WHERE domain_key = '$domain_key'") );
        $data = [];
        foreach($results as $result){
            $data = (array)$result;
        }
        return $data;
    }

    function recursive_f($content, $form_id, $form_name = ''){
        $id = 0;
        $tagName = $content->tag->name();
        if($tagName != "PhoneInput" && $tagName != 'text' && $content->hasChildren()){
            $childs = $content->getChildren();
            
            foreach($childs as $key => $child){
                $class = $child->getAttributes();
                $this->recursive_f($child, $form_id, $form_name);
    
            }
        } else {
            if( in_array($tagName, $this->fsiElements)){
                $this->field_counter++;
                $attributes = $content->getAttributes();
                $field_id = md5($content->outerHTML);
                $formField = ['site_form_id' => $form_id, 'field_id' => $field_id, 'field_name' => isset($attributes['name']) ? $attributes['name'] : $form_name.$this->field_counter, 'field_attribute_name' => $content->getAttribute('placeholder') ? $content->getAttribute('placeholder') : $form_name.$this->field_counter , 'field_content' => $content->outerHTML];
                $this->siteFormFieldData[$formField['field_id']] = $formField;
                
                
            }
        }
        return $id;
    }
}