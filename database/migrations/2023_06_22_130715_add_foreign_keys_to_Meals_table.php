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
        Schema::table('Meals', function (Blueprint $table) {
            $table->foreign(['category_id'], 'Meals_Category_id_category_fk')->references(['id_category'])->on('Category');
            $table->foreign(['Language_id'], 'Meals_Languages_language_id_fk')->references(['language_id'])->on('Languages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Meals', function (Blueprint $table) {
            $table->dropForeign('Meals_Category_id_category_fk');
            $table->dropForeign('Meals_Languages_language_id_fk');
        });
    }
};
