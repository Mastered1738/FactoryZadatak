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
        Schema::create('Meals', function (Blueprint $table) {
            $table->integer('category')->nullable();
            $table->integer('ingredient');
            $table->integer('tag');
            $table->string('meal_name')->nullable();
            $table->integer('meal_id')->primary();
            $table->string('meal_description');
            $table->string('status')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Meals');
    }
};
