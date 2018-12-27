<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Attendence;

class Classes extends Model
{
    protected $fillable = [
    	'date',
      'content',
      'classroom_id',
    ];

    protected $table = "classes";

    public function attendence(){

    	return $this->belongsToMany('App\User', 'attendences', 'class_id', 'user_id');
    }

    public function create($data, $classroom_id){

    	$this->date = $data['date'];
    	$this->content = $data['content'];
    	$this->classroom_id = $classroom_id;

    	$result = $this->save();

    	return ($result) ? true : false;

    }

    public function getPresenceInTheClass(){

        $studentsPresence =  $this->attendence()->select('attendences.id','users.name','attendences.presence')->get();

        return $studentsPresence;
    }

    public function updateClass($data){

        $this->date = $data['date'];
        $this->content = $data['content'];


        $result = $this->save();

        return ($result) ? true : false;
    }
}
