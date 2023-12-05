<?php

namespace Modules\Countries\Database\Seeders;

use Modules\Countries\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CountriesDatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
    }
}
