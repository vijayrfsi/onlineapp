<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fsi_model_infos', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 250);
            $table->integer('fsi_table_id')->default(1);
            $table->string('model_name', 250);
            $table->tinyText('class_name');
            $table->string('ref_id', 250);
            $table->dateTime('created_at');
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fsi_model_infos');
    }
};
