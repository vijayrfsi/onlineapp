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
        Schema::create('fsi_table_fields', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('field_name', 100);
            $table->string('real_name', 200);
            $table->string('field_display_name', 200);
            $table->string('backend_display_name', 250)->nullable();
            $table->integer('fsi_table_id');
            $table->string('field_type_id', 250);
            $table->string('field_id', 250);
            $table->integer('weight')->default(0);
            $table->timestamp('updated_at')->useCurrent();
            $table->integer('user_id');
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
        Schema::dropIfExists('fsi_table_fields');
    }
};
