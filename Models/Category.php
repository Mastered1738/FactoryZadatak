<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function getCategoryByTitle($category){
        return Category::where('title_category', $category)->get();
    }

    public function getCategoryBySlug($categorySlug){
        return Category::where('slug_category', $categorySlug)->get();
    }

    public function getCategoryById($categoryID){
        return Category::where('id_category', $categoryID)->get();
    }
}
