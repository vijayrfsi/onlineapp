<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FsiTableDefaultField;

class FsiTableDefaultFieldSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FsiTableDefaultField::insert([['id' => '1', 'field_name' => 'name', 'real_name' => 'name', 'field_display_name' => 'Name', 'backend_display_name' => 'Name', 'field_type_id' => 'string', 'weight' => 0, 'updated_at' => '2023-12-05 15:04:03', 'user_id' => 0, 'created_at' => '2023-12-05 09:33:29', ]]);
	
    }
}
