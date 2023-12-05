<?php

namespace Modules\Marks\Database\Seeders;

use Modules\Marks\Models\Mark;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MarksDatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
    }
}
