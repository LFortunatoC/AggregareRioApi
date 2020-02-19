<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable =['id','category_id','subCategory_id','menu_id','daysAvailable','hoursAvailable','picturePath','promoDays','promoValuePercent','value', 'active'];
}
