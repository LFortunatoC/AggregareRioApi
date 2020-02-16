<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionpool extends Model
{
    protected $fillable =['id','question', 'language_id','active'];
}
