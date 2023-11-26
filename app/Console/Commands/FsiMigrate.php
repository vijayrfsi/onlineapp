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

class FsiMigrate extends BaseCommand implements PromptsForMissingInput
{
    protected $signature = 'manage:table {name : The name of the migration}
    {--create= : The table to be created}
    {--domain_key= : The table to be created}
    {--form_key= : The table to be created}
    {--table= : The table to migrate}
    {--use-db-collation : Generate migrations with existing DB collation}
        {--path= : The location where the migration file should be created}
        {--realpath : Indicate any provided migration file paths are pre-resolved absolute paths}
        {--fullpath : Output the full path of the migration (Deprecated)}';
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
        $this->schema = $this->makeSchema();

        // It's possible for the developer to specify the tables to modify in this
        // schema operation. The developer may also specify if this table needs
        // to be freshly created so we can create the appropriate migrations.
        $name = Str::snake(trim($this->input->getArgument('name')));
        $this->db = DB::connection($this->options['connection']);
        $table = $this->input->getOption('table');
        $domain_key = $this->input->getOption('domain_key');
        $form_key = $this->input->getOption('form_key');
        $tableName = "contact_forms_{$domain_key}_{$form_key}";
        $formName = "{$domain_key}_{$form_key}";
        $tables       = $this->filterTables()->sort()->values();
        $formName = Str::studly($formName);


        $create = $this->input->getOption('create') ?: false;
        // If no table was given as an option but a create option is given then we
        // will use the "create" option as the table name. This allows the devs
        // to pass a table name into this option as a short-cut for creating.
        if (! $table && is_string($create)) {
            $table = $create;

            $create = true;
        }
       // $up = $this->getSchemaBlueprint($table, SchemaBuilder::CREATE());

        $blueprint = new TableBlueprint();
        $tables->each(function (string $table) use ($tableName, $domain_key, $form_key, $formName): void {

            $newTable = new \Doctrine\DBAL\Schema\Table($tableName);

            $doctrineTable = $this->schema->getDTable($table);
            $this->addColumns($domain_key, $form_key, $doctrineTable);
            $path = $this->tableMigration->write(
                $this->schema->getTableColumns($table, $doctrineTable, $newTable)
            );
            $pathArr = explode('database/', $path); 
            $path = "database/".$pathArr[1];   
            if(FacadesSchema::hasTable($tableName)){
                FacadesSchema::drop($tableName);
            }
            Artisan::call('migrate', [
                '--path' => $path,
                '--force' => true,
            ]);

            Artisan::call('fsi:page', [
                'name' => $formName, 
                '--form_key' => $form_key,
                '--form_name' => $formName,
                '--domain_key' => $domain_key,
                '--form_id' => 3,
                
            ]);
            $this->info("Created: $path");
        });



        // Next, we will attempt to guess the table name if this the migration has
        // "create" in the name. This will allow us to provide a convenient way
        // of creating migrations that create new tables for the application.
        if (! $table) {
            [$table, $create] = TableGuesser::guess($name);
        }

        // Now we are ready to write the migration out to disk. Once we've written
        // the migration out, we will dump-autoload for the entire framework to
        // make sure that the migrations are registered by the class loaders.
        //$this->writeMigration($name, $table, $create);

        $this->composer->dumpAutoloads();
    }

    /**
     * Write the migration file to disk.
     *
     * @param  string  $name
     * @param  string  $table
     * @param  bool  $create
     * @return string
     */
    protected function writeMigration($name, $table, $create)
    {
        $file = $this->creator->create(
            $name, $this->getMigrationPath(), $table, $create
        );

        $this->components->info(sprintf('Migration [%s] created successfully.', $file));
    }

    /**
     * Get migration path (either specified by '--path' option or default location).
     *
     * @return string
     */
    protected function getMigrationPath()
    {
        if (! is_null($targetPath = $this->input->getOption('path'))) {
            return ! $this->usingRealPath()
                            ? $this->laravel->basePath().'/'.$targetPath
                            : $targetPath;
        }

        return parent::getMigrationPath();
    }

    /**
     * Prompt for missing input arguments using the returned questions.
     *
     * @return array
     */
    protected function promptForMissingArgumentsUsing()
    {
        return [
            'name' => 'What should the migration be named?',
        ];
    }

    public function getData($domain_key, $form_key)
    {
        $this->doComment('Retrieving database tables');

        $whitelist = config('modelfromtable.whitelist', []);
        $blacklist = config('modelfromtable.blacklist', ['migrations']);

        if ($this->options['table']) {
            $whitelist = $whitelist + explode(',', $this->options['table']);
        }

        // mysql REGEXP behaves differently than fnmatch, so slightly modify operators
        $whitelistString = Str::replace('*', '.*', implode('|', $whitelist));
        $whitelistString = "($whitelistString)$";
        $blacklistString = Str::replace('*', '.*', implode('|', $blacklist));
        $blacklistString = "($blacklistString)$";




        $tbaleName = "contact_forms_{$domain_key}_{$form_key}";

        $query = $this->db
            ->query()
            ->select("field_config_data.*")
            ->from("contact_forms", "cf")
            ->join('sites', 'cf.site_id', '=', 'sites.id')
            //->join('field_configs', 'cf.id', '=', 'field_configs.contact_form_id')
            ->join('field_config_data', 'cf.id', '=', 'field_config_data.contact_form_id')

            ->where('form_key', $form_key)
            ->where('domain_key', $domain_key)
            ->orderBy('weight', 'ASC');

            \DB::enableQueryLog();

            $contact_forms = $query->get();
           // echo $lastQuery = DB::getQueryLog()[0]['query'];

        return $contact_forms
            ->groupBy('field_name')
            ->mapWithKeys(fn($x, $tableName) => [
                $tableName => [
                    'name' => $tableName,
                    'type' => $x[0]->field_type_id
                ]
        ]);
    }

    public function doComment($text, $overrideDebug = false)
    {
        if ($this->options['debug'] || $overrideDebug) {
            $this->comment($text);
        }
    }

    private function up(Table $table): SchemaBlueprint
    {
        $up = $this->getSchemaBlueprint($table, SchemaBuilder::CREATE());

        $blueprint = new TableBlueprint();

        if ($this->shouldSetCharset()) {
            $blueprint = $this->setTableCharset($blueprint, $table);
            $blueprint->setLineBreak();
        }

        if ($this->hasTableComment() && $table->getComment() !== null && $table->getComment() !== '') {
            $blueprint->setMethod(new Method(TableMethod::COMMENT(), $table->getComment()));
        }

        $chainableIndexes    = $this->indexGenerator->getChainableIndexes($table->getName(), $table->getIndexes());
        $notChainableIndexes = $this->indexGenerator->getNotChainableIndexes($table->getIndexes(), $chainableIndexes);

        foreach ($table->getColumns() as $column) {
            $method = $this->columnGenerator->generate($table, $column, $chainableIndexes);
            $blueprint->setMethod($method);
        }

        $blueprint->mergeTimestamps();

        if ($notChainableIndexes->isNotEmpty()) {
            $blueprint->setLineBreak();

            foreach ($notChainableIndexes as $index) {
                $method = $this->indexGenerator->generate($table, $index);
                $blueprint->setMethod($method);
            }
        }

        $up->setBlueprint($blueprint);

        return $up;
    }
    private function getSchemaBlueprint($table, SchemaBuilder $schemaBuilder): SchemaBlueprint
    {
        return new SchemaBlueprint(
            $table,
            $schemaBuilder
        );
    }

    protected function makeSchema(): Schema
    {
        $driver = DB::getDriverName();

        if (!$driver) {
            throw new Exception('Failed to find database driver.');
        }

        switch ($driver) {
            case Driver::MYSQL():
                return $this->schema = app(MySQLSchema::class);

            case Driver::PGSQL():
                return $this->schema = app(PgSQLSchema::class);

            case Driver::SQLITE():
                return $this->schema = app(SQLiteSchema::class);

            case Driver::SQLSRV():
                return $this->schema = app(SQLSrvSchema::class);

            default:
                throw new Exception('The database driver in use is not supported.');
        }
    }
    protected function filterAndExcludeAsset(Collection $allAssets): Collection
    {
        $tables = $allAssets;
        $tableArg = 'contact_forms_template';
        if ($tableArg !== '') {
            $tables = $allAssets->intersect(explode(',', $tableArg));
            return $tables->diff([]);
        }
        return $tables->diff([]);    
    }

    protected function filterTables(): Collection
    {
        $tables = $this->schema->getTableNames();

        return $this->filterAndExcludeAsset($tables);
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

    public function addColumns($domain_key, $form_key, $doctrineTable){
        $tables = $this->getData($domain_key, $form_key);
        $tables[] = ['name'=>'created_at', 'type'=>'datetime'];
        $tables[] = ['name'=>'updated_at', 'type'=>'datetime'];
        foreach ($tables as $table) {
            if (!$doctrineTable->hasColumn($table['name'])) {
                $column = $doctrineTable->addColumn($table['name'], $table['type']);
                $column->setNotnull(false);
                $column->setDefault(null);
            }        
        }

    } 
}

