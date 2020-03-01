<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{

 //   public static function findOrFail(int $id)
  //  {

   // }
 use SoftDeletes;
protected $fillable
        = [
            'title',
            'slug',
        'parent_id',
        'description',
    ];
}
