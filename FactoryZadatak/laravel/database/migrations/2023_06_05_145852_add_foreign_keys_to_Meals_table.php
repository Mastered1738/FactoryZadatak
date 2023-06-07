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
            $table->foreign(['category'], 'Meals_Category_id_category_fk')->references(['id_category'])->on('Category');
            $table->foreign(['ingredient'], 'Meals_Ingredients_id_ingredients_fk')->references(['id_ingredients'])->on('Ingredients');
            $table->foreign(['tag'], 'Meals_Tags_id_tag_fk')->references(['id_tag'])->on('Tags');
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
            $table->dropForeign('Meals_Ingredients_id_ingredients_fk');
            $table->dropForeign('Meals_Tags_id_tag_fk');
        });
    }
};
