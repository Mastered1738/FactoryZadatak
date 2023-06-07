<?php

use App\Models\Category;
use App\Models\Meals;
use Illuminate\Support\Facades\Route;
use App\Models\Tags;
use App\Models\Languages;
use App\Http\Controllers\LanguageController;
use App\Models\Ingredients;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    return view('welcome');

});

Route::get('/factory', function () {

    $per_page=request('per_page');
    $lang = request('lang');
    $tags = request('tags');
    $with = request('with');
    $page = request('page');


    if ($lang == ""){
        echo "Nije unesen zeljeni jezik!";
    }
    else{

        $result = array();

        $tag = "";
        $tagId = "";
        $ingredient = "";
        $ingredientId = "";
        $category1 = "";
        $categoryId = ""; 

        $languageId = Languages::where("language_name", $lang)->pluck("language_id");

        if ($per_page != 0) {
            array_push($result, "per_page: {$per_page}");
        }
        if ($tags != "") {
            $tagId = Tags::where("slug_tag", $tags)->pluck('id_tag');
            $tag = Tags::where("id_tag", $tagId)->get();
            array_push($result, $tag);
        }
        if ($with != "") {
                $dodatniParametri = explode(",", $with);
                foreach ($dodatniParametri as $dodatniParametar){
                    if ($dodatniParametar == "ingredients") {
                        $ingredientId = Meals::where("language_id", $languageId)->pluck("ingredient");
                        $ingredient = Ingredients::where("id_ingredients", $ingredientId)->get();
                        array_push($result, "Ingredient: {$ingredient}");
                    }
                    if ($dodatniParametar == "category") {
                        $categoryId = Meals::where("language_id", $languageId)->pluck("category");
                        $category1 = Category::where("id_category", $categoryId)->get();
                        array_push($result, "Category: {$category1}");
                    }
                    if ($dodatniParametar == "tags"){
                        $tagId = Tags::where("slug_tag", $tags)->pluck('id_tag');
                        $tag = Tags::where("id_tag", $tagId)->get();
                        array_push($result, $tag);
                    }
                }
            }
        }

        $query = Meals::query();

        $query->where("language_id", $languageId)->when($per_page != "", function($q){
            $per_page=request('per_page');
            return $q->take($per_page);
        })
        ->when($tagId != "", function($q){
            $tags = request('tags');
            $tagId = Tags::where("slug_tag", $tags)->pluck('id_tag');
            return $q->where("tag", $tagId);
        })->when($categoryId != "", function($q){
            $lang = request('lang');
            $languageId = Languages::where("language_name", $lang)->pluck("language_id");
            $categoryId = Meals::where("language_id", $languageId)->pluck("category");
            return $q->where("category", $categoryId);
        })->when($ingredientId != "", function($q){
            $lang = request('lang');
            $languageId = Languages::where("language_name", $lang)->pluck("language_id");
            $ingredientId = Meals::where("language_id", $languageId)->pluck("ingredient");
            return $q->where("ingredient", $ingredientId);
        });
        
        $queriedMeals = $query->get();
        
        array_push($result, $queriedMeals);

        return json_encode($result);
    }
);


