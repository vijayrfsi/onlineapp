<?php

namespace Modules\Cities\Database\Seeders;

use Modules\Cities\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CitiesDatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
    }
}
