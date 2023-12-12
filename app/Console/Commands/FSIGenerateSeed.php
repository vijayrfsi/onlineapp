<?php
 
namespace App\Console\Commands;
 
use App\User;
use App\Models\FsiTable;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class FSIGenerateSeed extends Command
{
    protected $rolesTableList = ['roles'];
    protected $usersTableList = ['users'];
    protected $processFirstTableList = ['abilities'];
    protected $columnTypes = [];
    protected $tableInsertList = ['abilities' => 'insertOrIgnore', 'users' => 'create'];
    protected $ingoreTableFields = ['abilities' => []];
    protected $keyReplacements = ['roles' => ['AssignRoleToPermission', 'RoleName', 'AbilityName']];
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fsi:seeder {name=all}
    {--model= : what schema to use}';
 
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a marketing email to a user';
 
    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $iname = $this->input->getArgument('name');
        if($iname != 'all'){
            $collection = \DB::table($iname)->get();
            $this->getGenerateSeed($collection, $iname);
            $this->doComment('seeder for '.$iname .' table generated');
        } else {
            $results = \DB::select('SHOW TABLES');
            foreach($results as $result){
                $result = (array) $result;
                foreach($result as $tableName){
                    if($tableName !="migrations"){
                        $this->getGenerateSeed($collection, $iname);
                    }
                }
            }
        }
    }

    public function getColumnInfos($tableName){
        $columnTypes = \DB::select('describe '.$tableName);
        foreach($columnTypes as $columnType){
            if(stristr($columnType->Type, 'int')){
                if($columnType->Null == "No"){
                    if($columnType->Default != ''){
                        $this->columnTypes[$columnType->Field] = $columnType->Default;
                    }
                } else {
                    if($columnType->Default == NULL){
                    $this->columnTypes[$columnType->Field] = 'NULL';
                    } else {
                        $this->columnTypes[$columnType->Field] = 0;
                    }
                }
            } else if(stristr($columnType->Type, 'char')){
                if($columnType->Null == "No"){
                    if($columnType->Default != ''){
                        $this->columnTypes[$columnType->Field] = "'".$columnType->Default."'";
                    }
                } else {
                    if($columnType->Default == NULL){
                    $this->columnTypes[$columnType->Field] = 'NULL';
                    } else {
                        $this->columnTypes[$columnType->Field] = 0;
                    }
                }
            } else if(stristr($columnType->Type, 'json')){
                $this->columnTypes[$columnType->Field] = 'NULL';
            } else {
                $this->columnTypes[$columnType->Field] = "''";
            }
        }
    }

    public function getGenerateSeed($collection, $tableName){
        $replacementArray = [];
        $userRoles = [];
        $rolesList = [];
        if($tableName == "users"){
            $assignedRolesCollection = \DB::table("assigned_roles")->get()->toArray();
            foreach($assignedRolesCollection as $assignedRole){
                ($assignedRole->entity_id);
                if(!isset($userRoles[$assignedRole->entity_id]))
                    $userRoles[$assignedRole->entity_id] = [$assignedRole->role_id];
                else 
                $userRoles[$assignedRole->entity_id][] = $assignedRole->role_id;
            }
            $rolesCollection = \DB::table("roles")->get()->toArray();
            foreach($rolesCollection as $role){
                $rolesList[$role->id] = $role->name;
            }
        }
        $model_name = $this->input->getOption('model');
        if($model_name == NULL && $tableName != 'all'){
            $model_name = Str::studly(Str::singular($tableName));
        }
        $this->getColumnInfos($tableName);
        $model_path = "App\\Models\\".$model_name;
        $content = '';
        $rowContent = '';
        $modelData = '';
        $chunks = $collection->chunk(10);

        $listFile = $this->getStubFiles($tableName);
        $templateFile = '';
        if(count($listFile)){
            $templateFile = $listFile[0];
        }
        $replacementArray['{ModelName}'] = $model_name;
        $replacementArray['{ModelPath}'] = $model_path;

        if(!in_array($tableName, $this->rolesTableList) && !in_array($tableName, $this->usersTableList)){
            $inc = 0;
            foreach($chunks->toArray() as $allRows){
                $rowData = [];
                foreach($allRows as $rowObj){
                    $row = (array) $rowObj;
                    $rowContent = '[';
                    //unset($row['created_at'], $row['updated_at']);
                    foreach($row as $column_name => $column_value){
                        if($this->isIgnoreField($tableName, $column_name)){
                            continue;
                        }
                        if($column_value != NULL)
                            $rowContent .= "'$column_name' => '$column_value', ";
                        else {
                            $rowContent .= "'$column_name' => ". $this->columnTypes[$column_name].", ";
                        }
                    }
                    $rowContent .= ']';
                    $rowData[] = $rowContent;
                }
                $modelData .="$model_name::".$this->getInsertQuery($tableName)."([".implode(", ", $rowData)."]);".PHP_EOL."\t";
            }
        } elseif(in_array($tableName, $this->rolesTableList)){
            $abilitiesCollection = \DB::table("abilities")->get()->toArray();
            $permissionCollection = \DB::table("permissions")->get()->toArray();
            foreach($permissionCollection as $permission){
                if(!isset($roleAbilities[$permission->entity_id]))
                    $roleAbilities[$permission->entity_id] = [$permission->ability_id];
                else 
                $roleAbilities[$permission->entity_id][] = $permission->ability_id;
            }
            $listArray = [];
            $inc = 0;
            foreach($chunks->toArray() as $allRows){
                $rowData = [];
                foreach($allRows as $rowObj){
                    $row = (array) $rowObj;
                    $replacements  = [];
                    foreach($row as $column_name => $column_value){
                        $replacements['{'.Str::studly(Str::singular("roles")).ucwords($column_name).'}'] = $column_value;
                    }
                    
                    
                    foreach($abilitiesCollection as $ability){
                        if(array_key_exists($row['id'], $roleAbilities)){
                            if(in_array($ability->id, $roleAbilities[$row['id']])){
                                $pageContent = file_get_contents($templateFile);
                                if(!$inc){
                                    $pageContent = trim($pageContent);
                                }
                                $inc = 1;
                                foreach($ability as $fieldName => $fieldData){
                                    $replacements['{'.Str::studly("ability").ucwords($fieldName).'}'] = $fieldData;
                                }
                                $pageContent = str_replace(
                                    array_keys($replacements),
                                    $replacements,
                                    $pageContent
                                );
                                $listArray[] = $pageContent;
                            }
                        }
                        
                    }
                }
            }
            $replacementArray['{AssignRoleToPermission}'] = implode(PHP_EOL, $listArray);

        } else {
            $inc = 0;
            foreach($chunks->toArray() as $allRows){
                $rowData = [];
                foreach($allRows as $rowObj){
                    $row = (array) $rowObj;
                    $rowContent = '[';
                    //unset($row['created_at'], $row['updated_at']);
                    foreach($row as $column_name => $column_value){
                        if($this->isIgnoreField($tableName, $column_name)){
                            continue;
                        }
                        if($column_value != NULL)
                            $rowContent .= "'$column_name' => '$column_value', ";
                        else {
                            $rowContent .= "'$column_name' => ". $this->columnTypes[$column_name].", ";
                        }
                    }
                    $rowContent .= ']';
                    $modelData .="\$user = $model_name::".$this->getInsertQuery($tableName)."(". $rowContent.");".PHP_EOL."\t";
                    
                    if(isset($userRoles[$row['id']])){
                        $counter = 1;
                        foreach($userRoles[$row['id']] as $role){
                            $replacements['{RoleName}'] = $rolesList[$role];
                            $pageContent = file_get_contents($templateFile);
                            $pageContent = str_replace(
                                array_keys($replacements),
                                $replacements,
                                $pageContent
                            );
                            if($counter == count($userRoles[$row['id']]))
                                $modelData .=$pageContent.PHP_EOL."\t\t";
                            else 
                                $modelData .=$pageContent.PHP_EOL."\t";
                            $counter++;
                        }
                    }
                }
                
            }
            
        }
        $replacementArray['{ModelData}'] = $modelData;
        $filePath = base_path().DIRECTORY_SEPARATOR."database/seeders/".$model_name."Seed.php";
        $pageContent = file_get_contents($this->getStub($tableName));
        $pageContent = str_replace(
            array_keys($replacementArray),
            $replacementArray,
            $pageContent
        );
        file_put_contents($filePath, $pageContent);
    }

    public function getStub($tableName)
    {
        $this->doComment('creating seeder stub');

         if(file_exists(base_path().'/stubs/migrate-seeder-generators/seeders/'.$tableName.'/ModelSeed.php')){
            return base_path().'/stubs/migrate-seeder-generators/seeders/'.$tableName.'/ModelSeed.php';
         } else {
            return base_path().'/stubs/migrate-seeder-generators/seeders/ModelSeed.php';
         }
    }

    public function getStubFiles($tableName){
        return glob(base_path().'/stubs/migrate-seeder-generators/seeders/'.$tableName.'/_fields/list.php');
    }

    public function doComment($text, $overrideDebug = false)
    {
            $this->comment($text);
    }

    public function getInsertQuery($tableName){
        if(isset($this->tableInsertList[$tableName])){
            return $this->tableInsertList[$tableName];
        } else {
            return 'insert';
        }
    }
    public function isIgnoreField($tableName, $fieldName){
        if(isset($this->ingoreTableFields[$tableName])){
            if(isset($this->ingoreTableFields[$tableName][$fieldName])){
                return true;
            }
        }
        return false;
    }
}