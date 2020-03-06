<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemTitleDescription extends Model
{
    protected $fillable =['id','item_id', 'language_id','title','description','active','created_at','updated_at'];


    public function scopeOfItemLanguage($query, $item_id, $language_id)
    {
        return $query->where(['item_id'=>$item_id,'language_id'=>$language_id]);

    }

    public function scopeOfLanguage($query, $language_id)
    {
        return $query->where('language_id',$language_id);

    }
    
}
