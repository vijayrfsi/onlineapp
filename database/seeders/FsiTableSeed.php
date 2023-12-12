<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FsiTable;

class FsiTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FsiTable::insert([['id' => '1','name' => 'degrees','fsi_type_id' => '1','created_at' => '2023-11-23 12:27:08','updated_at' => '2023-11-23 17:57:15',], ['id' => '2','name' => 'classes','fsi_type_id' => '1','created_at' => '2023-11-23 12:27:25','updated_at' => '2023-11-23 17:57:31',], ['id' => '3','name' => 'countries','fsi_type_id' => '1','created_at' => '2023-11-24 06:50:25','updated_at' => '2023-11-24 12:20:54',], ['id' => '4','name' => 'states','fsi_type_id' => '1','created_at' => '2023-11-24 06:50:25','updated_at' => '2023-11-24 12:20:54',], ['id' => '5','name' => 'cities','fsi_type_id' => '1','created_at' => '2023-11-24 06:50:25','updated_at' => '2023-11-24 12:21:10',], ['id' => '7','name' => 'candidate_profiles','fsi_type_id' => '1','created_at' => '2023-11-24 06:51:18','updated_at' => '2023-11-24 12:21:29',], ['id' => '8','name' => 'districts','fsi_type_id' => '1','created_at' => '2023-11-26 07:55:45','updated_at' => '2023-12-05 13:29:12',], ['id' => '9','name' => 'posts','fsi_type_id' => '1','created_at' => '2023-11-26 12:19:44','updated_at' => '2023-11-26 17:49:50',], ['id' => '10','name' => 'fsi_menus','fsi_type_id' => '1','created_at' => '2023-12-05 04:02:49','updated_at' => '2023-12-05 09:33:09',], ['id' => '11','name' => 'fsi_menu_items','fsi_type_id' => '1','created_at' => '2023-12-05 04:02:49','updated_at' => '2023-12-05 09:33:09',]]);
	FsiTable::insert([['id' => '12','name' => 'blogs','fsi_type_id' => '1','created_at' => '2023-12-05 08:11:50','updated_at' => '2023-12-05 13:41:55',]]);
	
    }
}
