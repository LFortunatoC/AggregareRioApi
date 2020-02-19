<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable =['id','tableNumber','canceled','deliveredAt','createdAt'.'upadateAt'];
}
