<?php

namespace Modules\Semesters\Database\Seeders;

use Modules\Semesters\Models\Semester;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SemestersDatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
    }
}
