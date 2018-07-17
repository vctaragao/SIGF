<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Class extends Model
{
    protected $fillable = [
        'content',
        'status',
        'classroom_id',
    ];

    protected $table = "classes";
}
