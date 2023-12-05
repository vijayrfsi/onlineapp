<?php

namespace Modules\{Module}\Database\Seeders;

use Modules\{Module}\Models\{Model};
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class {Module}DatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
    }
}
