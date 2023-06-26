<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Meals extends Model
{
    use HasFactory;

    public function getMealByCategory($category){
        return DB::table('Meals')->where('category_id', $category)->get();
    }

    public function getMealIDByCategory($category){
        return DB::table('Meals')->select('MealsID')->where('category_id', $category)->pluck('MealsID');
    }

    public function getMealIDByLangugageID($language){
        return DB::table('Meals')->select('MealsID')->where('Language_id', $language)->pluck('MealsID');
    }

    public function getAllMealIDs(){
        return DB::table('Meals')->select('MealsID')->pluck('MealsID');
    }

    public function getMealByID($mealID){
        return DB::table('Meals')->where('MealsID', $mealID)->get()->first();
    }
}
