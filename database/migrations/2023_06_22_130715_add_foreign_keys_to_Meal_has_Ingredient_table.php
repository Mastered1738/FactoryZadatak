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
        Schema::table('Meal_has_Ingredient', function (Blueprint $table) {
            $table->foreign(['ingredient_id'], 'Meal_has_Ingredient_Ingredients_id_ingredients_fk')->references(['id_ingredients'])->on('Ingredients');
            $table->foreign(['meal_id'], 'Meal_has_Ingredient_Meals_MealsID_fk')->references(['MealsID'])->on('Meals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Meal_has_Ingredient', function (Blueprint $table) {
            $table->dropForeign('Meal_has_Ingredient_Ingredients_id_ingredients_fk');
            $table->dropForeign('Meal_has_Ingredient_Meals_MealsID_fk');
        });
    }
};
