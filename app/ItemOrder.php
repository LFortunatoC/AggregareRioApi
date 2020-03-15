<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemOrder extends Model
{
    protected $fillable =['id','item_id','order_id', 'qty','currPrice','canceled'];

    public function items() {
        return $this->hasMany('App\ItemTitleDescription', 'item_id', 'item_id');
    }

    public function scopeOfOrder ($query, $id)
    {
        return $query->where('order_id', $id);
    }
}
