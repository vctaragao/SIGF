<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Classroom extends Model
{
    protected $fillabe =[
    	'user_id',
    	'classroom_id',
    	'role',
    	'wait',
    ];

    protected $table = 'user_classrooms';
}
