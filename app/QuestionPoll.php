<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionPoll extends Model
{
    protected $fillable =['id','question','active'];
}
