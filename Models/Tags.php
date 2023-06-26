<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tags extends Model
{
    use HasFactory;

    public function getTagfromTagID($tagid){
        return DB::table('Tags')->where('id_tag',$tagid)->get();
    }
}
