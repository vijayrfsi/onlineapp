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
        Schema::create('fsi_routes', function (Blueprint $table) {
            $table->id();
            $table->string('domain', 100)->nullable();
            $table->string('name', 250)->nullable();
            $table->string('url', 250)->nullable();
            $table->string('method', 250)->nullable();
            $table->string('action', 250)->nullable();            
            $table->string('action_class', 250)->nullable();
            $table->string('action_method', 250)->nullable();
            $table->string('middleware', 250)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fsi_routes');
    }
};
