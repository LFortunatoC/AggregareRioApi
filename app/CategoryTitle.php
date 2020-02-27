<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryTitle extends Model
{
    protected $fillable =['id', 'category_id', 'language_id', 'description'];
}
