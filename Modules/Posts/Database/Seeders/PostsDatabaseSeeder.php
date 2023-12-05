<?php

namespace Modules\Posts\Database\Seeders;

use Modules\Posts\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PostsDatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
    }
}
