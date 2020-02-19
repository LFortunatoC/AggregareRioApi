<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable =['id','category_id', 'subCategory_id','menu_id','value', 'picturePath', 'active'];
}