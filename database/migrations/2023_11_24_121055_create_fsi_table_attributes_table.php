<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFsiTableAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fsi_table_attributes', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('fsi_table_id');
            $table->string('fsi_table_ref_id', 250);
            $table->tinyInteger('has_children')->default(0);
            $table->string('column_name', 250);
            $table->dateTime('created_at');
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fsi_table_attributes');
    }
}
