<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FsiTableFieldAttribute;

class FsiTableFieldAttributeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FsiTableFieldAttribute::insert([['id' => '1', 'fsi_table_field_id' => '1290', 'field_type' => 'select', 'weight' => 0, 'model_type' => 'self', 'updated_at' => '2023-12-05 11:19:52', 'created_at' => '2023-12-05 05:49:36', ]]);
	
    }
}
