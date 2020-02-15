<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable =['id','description', 'active','language_id','created_at','updated_at'];
}
