<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MealHasTag extends Model
{
    use HasFactory;

    public function getMealIDFromTagID($tagID){
        return DB::table('Meal_has_Tag')->select('meal_id')->where('tag_id', $tagID)->pluck('meal_id');
    }

    public function getMealsFromID($mealID){
        return DB::table('Meal_has_Tag')->where('meal_id', $mealID)->get();
    }

    public function getTagIDFromMealID($mealID){
        return DB::table('Meal_has_Tag')->select('tag_id')->where('meal_id', $mealID)->pluck('tag_id');
    }
}
