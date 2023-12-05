<?php

namespace Modules\Makes\Database\Seeders;

use Modules\Makes\Models\Make;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MakesDatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
    }
}
