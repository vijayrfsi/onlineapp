<?php

use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lastProcessData = ['AbilitySeed' => ''];
        foreach(glob(base_path()."/database/seeders/*") as $file){
            if(!stristr($file, '/AbilitySeed')){
                if(!stristr($file, '/DatabaseSeeder')){
                    if(class_exists("Database\\Seeders\\".basename($file, '.php'))){
                        $this->call("Database\\Seeders\\".basename($file, '.php'));
                    }elseif(class_exists(basename($file, '.php'))){
                        $this->call(basename($file, '.php'));
                    }
                }
            } else {
                if(class_exists("Database\\Seeders\\".basename($file, '.php'))){
                    $lastProcessData['AbilitySeed'] = "Database\\Seeders\\".basename($file, '.php');
                }elseif(class_exists(basename($file, '.php'))){
                    $lastProcessData['AbilitySeed'] = basename($file, '.php');
                }
            }

        }
        foreach($lastProcessData as $file){
            if(class_exists($file)){
                $this->call($file);
            }
        }
    }
}
