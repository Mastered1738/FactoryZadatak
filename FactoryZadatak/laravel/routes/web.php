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
                }
            }
        }

        $allMeals = Meals::where("language_id", $languageId)->orWhere("tag",$tagId)->orWhere("category", $categoryId)->orWhere("ingredient", $ingredientId)->get();
        array_push($result, $allMeals);

        return json_encode($result);
    }
);


