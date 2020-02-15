<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Title_desc extends Model
{
    protected $fillable =['id','item_id','language_id','title','description', 'active'];
}
