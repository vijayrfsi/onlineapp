<?php

namespace Modules\Classes\Database\Seeders;

use Modules\Classes\Models\Class;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ClassesDatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
    }
}
