<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TitleDesc extends Model
{
    protected $fillable =['id','item_id','language_id','title','description', 'active'];
}
