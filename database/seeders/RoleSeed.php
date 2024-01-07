<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Bouncer::allow('administrator')->to('users_manage');
        \Bouncer::allow('administrator')->to('blogs_manage');
        \Bouncer::allow('administrator')->to('fsi_tables_manage');
        \Bouncer::allow('administrator')->to('fsi_tables_attributes_manage');
        \Bouncer::allow('administrator')->to('tests_manage');
        \Bouncer::allow('student')->to('users_manage');
        \Bouncer::allow('staff')->to('users_manage');
        \Bouncer::allow('management')->to('users_manage');
        \Bouncer::allow('Invigilator')->to('users_manage');
        \Bouncer::allow('Examiner')->to('users_manage');
        \Bouncer::allow('Examiner')->to('questions_manage');
        \Bouncer::allow('Examiner')->to('answers_manage');
    }
}
