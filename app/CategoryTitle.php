<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryTitle extends Model
{
    protected $fillable =['id', 'category_id', 'language_id', 'description'];

    public function scopeOfCategoryAndLanguage($query, $language_id, $category_id)
    {
        return $query->where(['language_id' => $language_id, 'category_id'=>$category_id]);

    }

    public function scopeOfLanguage($query, $language_id)
    {
        return $query->where('language_id', $language_id);

    }
}
