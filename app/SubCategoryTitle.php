<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategoryTitle extends Model
{
    protected $fillable =['id', 'sub_category_id', 'language_id', 'description'];

    public function scopeOfSubCategoryAndLanguage($query, $language_id, $subCategory_id)
    {
        return $query->where(['language_id' => $language_id, 'sub_category_id'=>$subCategory_id]);

    }

    public function scopeOfLanguage($query, $language_id)
    {
        return $query->where('language_id', $language_id);

    }

}
