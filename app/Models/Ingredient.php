<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ingredient extends Model
{
    use HasFactory;

    public function getIngredientFromIngredientID($ingredientID){
        return DB::table('Ingredients')->where('id_ingredients', $ingredientID)->get();
    }

    
}
