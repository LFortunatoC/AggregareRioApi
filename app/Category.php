<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable =['id', 'description', 'active','created_at','updated_at'];

    
}
