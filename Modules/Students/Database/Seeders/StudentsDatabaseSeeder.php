<?php

namespace Modules\Students\Database\Seeders;

use Modules\Students\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class StudentsDatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
    }
}
