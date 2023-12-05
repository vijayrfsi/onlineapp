<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create{Module}Table extends Migration
{
    public function up()
    {
        Schema::dropIfExists('{module_}');
        Schema::create('{module_}', function (Blueprint $table) {
            $table->id();
            {field_name}
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('{module_}');
    }
}
