<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create(['id' => '1', 'name' => 'Admin', 'email' => 'admin@admin.com', 'password' => '$2y$10$Go9YLoym0Mdw4iOSyifC7url2230gON3iUtyxnoYQZyKQowLRSDQS', 'remember_token' => NULL, 'created_at' => '2023-12-12 16:13:11', 'updated_at' => '2023-12-12 16:13:11', ]);
	    $user->assign('administrator');
		$user = User::create(['id' => '2', 'name' => 'Vijay', 'email' => 'rvijayee@gmail.com', 'password' => '$2y$10$IaiN6Ktbv/P1DQuStUevMu0jfXIxOryOJAgvLE2Cmml2VxigK5/U.', 'remember_token' => NULL, 'created_at' => '2023-12-12 16:24:38', 'updated_at' => '2023-12-12 16:24:38', ]);
	    $user->assign('manager');
		
    }
}
