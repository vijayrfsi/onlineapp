<?php

namespace Modules\Degrees\Database\Seeders;

use Modules\Degrees\Models\Degree;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DegreesDatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
    }
}
