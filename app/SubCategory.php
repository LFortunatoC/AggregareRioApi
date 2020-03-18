<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable =['id', 'category_id', 'active','description','created_at','updated_at'];
}
