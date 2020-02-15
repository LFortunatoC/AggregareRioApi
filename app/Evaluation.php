<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable =['id','order_id', 'questionPoll_id','client_id','evaluationValue','comment'];
}
