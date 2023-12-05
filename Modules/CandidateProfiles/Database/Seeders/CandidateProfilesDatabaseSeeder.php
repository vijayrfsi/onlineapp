<?php

namespace Modules\CandidateProfiles\Database\Seeders;

use Modules\CandidateProfiles\Models\CandidateProfile;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CandidateProfilesDatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
    }
}
