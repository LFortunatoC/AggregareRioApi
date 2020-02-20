<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable =['id','item_id','daysAvailable','startTime','finishTime', 'promoValuePercent','value', 'active'];
}
