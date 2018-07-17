<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendece extends Model
{
    protected $fillabe = [
    	'user_id',
    	'class_id',
    	'presence'
    ];
}
