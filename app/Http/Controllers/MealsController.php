<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Languages;
use App\Models\Category;
use App\Models\Tags;
use App\Models\Ingredient;
use App\Models\MealHasIngredient;
use App\Models\MealHasTag;
use App\Models\Meals;
use Illuminate\Support\Facades\DB;
use Psy\Readline\Hoa\EventListenable;

class MealsController extends Controller
{
    public function filtrirajJela(Request $request){

        $languageModel = new Languages();
        $categoryModel = new Category();
        $MealsModel = new Meals();
        $TagsModel = new Tags();
        $IngredientModel = new Ingredient();
        $MealHasIngredient = new MealHasIngredient();
        $MealHasTag = new MealHasTag();


        $langParameter = $request->lang; 
        $perPageParemeter = $request->per_page;
        $categoryParemeter = $request->category;
        $tagsParameter = $request->tags;
        $withParameter = $request->with;

        $conditionsArray = array();
        
        if ($langParameter == '') {
           return "Error: Language not specified!";
        }
        else{
            
            $odabranJezikID = $languageModel->getLanguageID($langParameter);

            $mealIDArray = $MealsModel->getMealIDByLangugageID($odabranJezikID);

            $languageMealIDArray = array();

            foreach ($mealIDArray as $mealid) {
                array_push($languageMealIDArray, $mealid);
            }

            $mealResultArray = array();

            $tagMealIDArray = array();

            $categoryMealIDArray = array();

            if ($tagsParameter != '') {
                $mealtagidIdArray = $MealHasTag->getMealIDFromTagID($tagsParameter);
                foreach ($mealtagidIdArray as $mealtag){
                    array_push($tagMealIDArray, $mealtag);
                }                
            }
            else{
                $mealtagidIdArray = $MealsModel->getAllMealIDs();
                foreach ($mealtagidIdArray as $mealtag){
                    array_push($tagMealIDArray, $mealtag);
                }     
            }

            if ($categoryParemeter == 'NULL') {
                $categoryMealId = $MealsModel->getMealIDByCategory(NULL);
                foreach($categoryMealId as $mealid){
                    array_push($categoryMealIDArray, $mealid);
                } 
            }
            elseif($categoryParemeter != ''){
                $categoryMealId = $MealsModel->getMealIDByCategory($categoryParemeter);
                foreach($categoryMealId as $mealid){
                    array_push($categoryMealIDArray, $mealid);
                }
            }
            else{
                $categoryMealId = $MealsModel->getAllMealIDs();
                foreach($categoryMealId as $mealid){
                    array_push($categoryMealIDArray, $mealid);
                }
            }

            $resultIntersectArray = array_intersect($languageMealIDArray, $tagMealIDArray, $categoryMealIDArray);

            $finalQueryResult = array();

            if ($withParameter  != '') {
                $withParameterArray = explode(',', $withParameter);

                foreach ($resultIntersectArray as $mealid) {

                    $meal = $MealsModel->getMealByID($mealid);

                    array_push($finalQueryResult, $meal);

                    foreach($withParameterArray as $parameter){
                        if ($parameter == 'ingredients') {
                            $ingredientArray = array();
                            $ingredients = $MealHasIngredient->getIngredientIDByMealID($mealid);
                            array_push($ingredientArray, $ingredients);
                            
                            foreach ($ingredientArray as $ingredientid) {
                                $ingredientFromIngredientTable = $IngredientModel->getIngredientFromIngredientID($ingredientid);
                                array_push($finalQueryResult, $ingredientFromIngredientTable);
                            }          
                        }
                        if ($parameter == 'category' && $categoryParemeter != '') {
                            $category = $categoryModel->getCategoryById($categoryParemeter);
                            array_push($finalQueryResult, $category);
                        }
                        if ($parameter == 'tags') {
                            $tagsArray = array();
                            $tags = $MealHasTag->getTagIDFromMealID($mealid);
                            array_push($tagsArray, $tags);

                            foreach ($tagsArray as $tagid) {
                                $tagfromtagtable = $TagsModel->getTagfromTagID($tagid);
                                array_push($finalQueryResult, $tagfromtagtable);
                            }                            
                        }

                    }

                }
                
                return $finalQueryResult;
            }
            else{

                foreach ($resultIntersectArray as $mealid) {
                    
                    $meal = $MealsModel->getMealByID($mealid);

                    array_push($finalQueryResult, $meal);
                }

                return $finalQueryResult;
            }

        }
        
    }
}
