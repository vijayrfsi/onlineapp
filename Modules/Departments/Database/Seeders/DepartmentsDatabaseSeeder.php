<?php

namespace Modules\Departments\Database\Seeders;

use Modules\Departments\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DepartmentsDatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
    }
}
