<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FsiModelInfo;

class FsiModelInfoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FsiModelInfo::insert([['id' => '638', 'name' => 'degrees', 'fsi_table_id' => '1', 'model_name' => 'Degree', 'class_name' => 'Modules\Degrees\Models\Degree', 'ref_id' => 'degree_id', 'created_at' => '2023-12-12 17:24:02', 'updated_at' => '2023-12-12 17:24:02', ], ['id' => '639', 'name' => 'classes', 'fsi_table_id' => '2', 'model_name' => 'Class', 'class_name' => '', 'ref_id' => 'class_id', 'created_at' => '2023-12-12 17:24:02', 'updated_at' => '2023-12-12 17:24:02', ], ['id' => '640', 'name' => 'countries', 'fsi_table_id' => '3', 'model_name' => 'Country', 'class_name' => '', 'ref_id' => 'country_id', 'created_at' => '2023-12-12 17:24:02', 'updated_at' => '2023-12-12 17:24:02', ], ['id' => '641', 'name' => 'states', 'fsi_table_id' => '4', 'model_name' => 'State', 'class_name' => '', 'ref_id' => 'state_id', 'created_at' => '2023-12-12 17:24:02', 'updated_at' => '2023-12-12 17:24:02', ], ['id' => '642', 'name' => 'cities', 'fsi_table_id' => '5', 'model_name' => 'City', 'class_name' => '', 'ref_id' => 'city_id', 'created_at' => '2023-12-12 17:24:02', 'updated_at' => '2023-12-12 17:24:02', ], ['id' => '643', 'name' => 'candidate_profiles', 'fsi_table_id' => '7', 'model_name' => 'CandidateProfile', 'class_name' => '', 'ref_id' => 'candidate_profile_id', 'created_at' => '2023-12-12 17:24:02', 'updated_at' => '2023-12-12 17:24:02', ], ['id' => '644', 'name' => 'districts', 'fsi_table_id' => '8', 'model_name' => 'District', 'class_name' => '', 'ref_id' => 'district_id', 'created_at' => '2023-12-12 17:24:02', 'updated_at' => '2023-12-12 17:24:02', ], ['id' => '645', 'name' => 'posts', 'fsi_table_id' => '9', 'model_name' => 'Post', 'class_name' => '', 'ref_id' => 'post_id', 'created_at' => '2023-12-12 17:24:02', 'updated_at' => '2023-12-12 17:24:02', ], ['id' => '646', 'name' => 'fsi_menus', 'fsi_table_id' => '10', 'model_name' => 'FsiMenu', 'class_name' => 'app\Models\FsiMenu', 'ref_id' => 'fsi_menu_id', 'created_at' => '2023-12-12 17:24:02', 'updated_at' => '2023-12-12 17:24:02', ], ['id' => '647', 'name' => 'fsi_menu_items', 'fsi_table_id' => '11', 'model_name' => 'FsiMenuItem', 'class_name' => 'app\Models\FsiMenuItem', 'ref_id' => 'fsi_menu_item_id', 'created_at' => '2023-12-12 17:24:02', 'updated_at' => '2023-12-12 17:24:02', ]]);
	FsiModelInfo::insert([['id' => '648', 'name' => 'blogs', 'fsi_table_id' => '12', 'model_name' => 'Blog', 'class_name' => 'app\Models\Blog', 'ref_id' => 'blog_id', 'created_at' => '2023-12-12 17:24:02', 'updated_at' => '2023-12-12 17:24:02', ]]);
	
    }
}
