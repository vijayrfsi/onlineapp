<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFsiMenuItemsTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('fsi_menu_items');
        Schema::create('fsi_menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('fsi_menu_id');
            $table->integer('parent_id');
            $table->string('icon_name');
            $table->string('icon_text');
            $table->integer('weight');
            $table->integer('has_children');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fsi_menu_items');
    }
}
