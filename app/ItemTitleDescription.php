<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemTitleDescription extends Model
{
    protected $fillable =['id','item_id', 'language_id','title','description','active','created_at','updated_at'];


    public function scopeOfLanguage($query, $id)
    {
        return $query->where('language_id', $id);

    }
    
}
