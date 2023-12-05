<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFsiMenusTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('fsi_menus');
        Schema::create('fsi_menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fsi_menus');
    }
}
