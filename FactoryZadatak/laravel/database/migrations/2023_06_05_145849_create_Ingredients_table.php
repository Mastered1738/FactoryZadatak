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
        Schema::create('Ingredients', function (Blueprint $table) {
            $table->integer('id_ingredients')->primary();
            $table->string('title_ingedients');
            $table->string('slug_ingredients')->unique('Ingredients_slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Ingredients');
    }
};
