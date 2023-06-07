<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Languages;

class LanguageController extends Controller
{
    public function getLanguage($language){
        return Languages::where("language_name", $language)->get();
    }
}
