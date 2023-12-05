<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateProfilesTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('candidate_profiles');
        Schema::create('candidate_profiles', function (Blueprint $table) {
            $table->id();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('candidate_profiles');
    }
}
