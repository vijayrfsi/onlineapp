<?php

namespace Modules\Subjects\Database\Seeders;

use Modules\Subjects\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SubjectsDatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
    }
}
