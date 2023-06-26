<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class MealHasIngredient extends Model
{
    use HasFactory;

    public function getIngredientIDByMealID($mealID){
        return DB::table('Meal_has_Ingredient')->select('ingredient_id')->where('meal_id',$mealID)->pluck('ingredient_id');
    }
}
