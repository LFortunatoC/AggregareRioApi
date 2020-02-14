<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluantion extends Model
{
    protected $fillable =['id','order_id', 'questionPoll_id','client_id','evaluationValue','comment'];
}
