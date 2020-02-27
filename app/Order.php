<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable =['id','tableNumber','canceled','deliveredAt','createdAt'.'upadateAt'];


    public function items() {
        return $this->hasMany('App\ItemOrder', 'order_id', 'id');
    }
}
