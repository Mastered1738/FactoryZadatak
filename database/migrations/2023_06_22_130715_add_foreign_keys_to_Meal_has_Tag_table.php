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
        Schema::table('Meal_has_Tag', function (Blueprint $table) {
            $table->foreign(['meal_id'], 'Meal_has_Tag_Meals_MealsID_fk')->references(['MealsID'])->on('Meals');
            $table->foreign(['tag_id'], 'Meal_has_Tag_Tags_id_tag_fk')->references(['id_tag'])->on('Tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Meal_has_Tag', function (Blueprint $table) {
            $table->dropForeign('Meal_has_Tag_Meals_MealsID_fk');
            $table->dropForeign('Meal_has_Tag_Tags_id_tag_fk');
        });
    }
};
