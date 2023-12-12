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
        Schema::create('fsi_table_field_attributes', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('fsi_table_field_id');
            $table->string('field_type', 10);
            $table->integer('weight')->default(0);
            $table->string('model_type', 100);
            $table->timestamp('updated_at')->useCurrent();
            $table->dateTime('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fsi_table_field_attributes');
    }
};
