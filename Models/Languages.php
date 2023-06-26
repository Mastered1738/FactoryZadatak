<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Languages extends Model
{
    use HasFactory;
    
    public function getLanguageID($language){
        return DB::table('Languages')->select('language_id')->where('language_name', $language)->value('language_id');
    }

    public function getLanguage($language){
        return DB::table('Languages')->where('language_name', $language)->get();
    }

}
