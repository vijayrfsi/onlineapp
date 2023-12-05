<?php

namespace Modules\Brands\Database\Seeders;

use Modules\Brands\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class BrandsDatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
    }
}
