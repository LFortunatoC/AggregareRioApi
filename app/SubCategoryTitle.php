<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategoryTitle extends Model
{
    protected $fillable =['id', 'sub_category_id', 'language_id', 'description'];
}
