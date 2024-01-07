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
		$user = User::create(['id' => '3', 'name' => 'student1', 'email' => 'stident+rvijayee@gmail.com', 'password' => '$2y$10$qQH0Px.8thyZBUBzTC86mOLMo6xaISwEzHznd22klz5YL/9H2zMDW', 'remember_token' => NULL, 'created_at' => '2024-01-07 08:40:05', 'updated_at' => '2024-01-07 08:40:05', ]);
	    $user->assign('student');
		$user = User::create(['id' => '4', 'name' => 'Student 2', 'email' => 'stident2+rvijayee@gmail.com', 'password' => '$2y$10$ttxfKouUbp2HqaMBfPfTO.Ar1dFEJ1kHwT9rMLA4S/snw40gr2S4e', 'remember_token' => NULL, 'created_at' => '2024-01-07 08:40:29', 'updated_at' => '2024-01-07 08:40:29', ]);
	    $user->assign('student');
		$user = User::create(['id' => '5', 'name' => 'Invigilator', 'email' => 'invigilator+rvijayee@gmail.com', 'password' => '$2y$10$SUq0MW9v9LUmUHY7gRL6EOCPY6NI94c2CbBlppLiw4V2Ya7Lsjenu', 'remember_token' => NULL, 'created_at' => '2024-01-07 08:40:53', 'updated_at' => '2024-01-07 08:40:53', ]);
	    $user->assign('Invigilator');
		$user = User::create(['id' => '6', 'name' => 'Examiner', 'email' => 'examiner+rvijayee@gmail.com', 'password' => '$2y$10$mN2lr0dEjRKjjLJWtTYw9OVNYrnwCun.pAm./he5h18ff1UAULkrO', 'remember_token' => NULL, 'created_at' => '2024-01-07 08:41:24', 'updated_at' => '2024-01-07 08:41:24', ]);
	    $user->assign('Examiner');
		
    }
}
