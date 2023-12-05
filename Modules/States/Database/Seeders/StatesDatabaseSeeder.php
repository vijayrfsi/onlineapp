<?php

namespace Modules\States\Database\Seeders;

use Modules\States\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class StatesDatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
    }
}
