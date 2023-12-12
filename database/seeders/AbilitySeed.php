<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ability;

class AbilitySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ability::insertOrIgnore([['id' => '1', 'name' => 'fsi_tables_attributes_manage', 'title' => 'Fsi tables attributes manage', 'entity_id' => NULL, 'entity_type' => NULL, 'only_owned' => 0, 'options' => NULL, 'scope' => NULL, 'created_at' => '2023-12-12 13:47:08', 'updated_at' => '2023-12-12 13:47:08', ], ['id' => '2', 'name' => 'blogs_manage', 'title' => 'Blogs manage', 'entity_id' => NULL, 'entity_type' => NULL, 'only_owned' => 0, 'options' => NULL, 'scope' => NULL, 'created_at' => '2023-12-12 13:18:12', 'updated_at' => '2023-12-12 13:18:12', ], ['id' => '3', 'name' => 'fsi_tables_manage', 'title' => 'Fsi tables manage', 'entity_id' => NULL, 'entity_type' => NULL, 'only_owned' => 0, 'options' => NULL, 'scope' => NULL, 'created_at' => '2023-12-12 13:18:12', 'updated_at' => '2023-12-12 13:18:12', ], ['id' => '4', 'name' => 'fsi_tables_attributes_manage', 'title' => 'Fsi tables attributes manage', 'entity_id' => NULL, 'entity_type' => NULL, 'only_owned' => 0, 'options' => NULL, 'scope' => NULL, 'created_at' => '2023-12-12 13:18:12', 'updated_at' => '2023-12-12 13:18:12', ]]);
	
    }
}
