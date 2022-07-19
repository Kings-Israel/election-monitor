<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAspirantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aspirants', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('uuid')->nullable();
            $table->string('full_name')->nullable();
            $table->string('political_party')->nullable();
            $table->string('electoral_position')->nullable();
            $table->string('electoral_area')->nullable();
            $table->string('results')->nullable();
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('aspirants');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
