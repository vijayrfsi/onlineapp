<?php

namespace Modules\Blogs\Database\Seeders;

use Modules\Blogs\Models\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class BlogsDatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
    }
}
