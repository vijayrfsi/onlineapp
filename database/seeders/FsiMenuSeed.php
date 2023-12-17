<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FsiMenu;

class FsiMenuSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FsiMenu::insert([['id' => '1', 'name' => 'Sidebar', 'created_at' => '2023-12-16 04:43:55', 'updated_at' => '2023-12-16 04:43:55', ]]);
	
    }
}
