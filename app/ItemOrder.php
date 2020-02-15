<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemOrder extends Model
{
    protected $fillable =['id','order_id', 'qty','currPrice','canceled'];
}
