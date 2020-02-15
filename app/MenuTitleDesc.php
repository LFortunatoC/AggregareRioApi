<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuTitleDesc extends Model
{
    protected $fillable =['id','menu_id','language_id','title','description','altText1','altText2', 'active'];
}
