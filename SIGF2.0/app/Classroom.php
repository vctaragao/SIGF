<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User_Classroom;
use Illuminate\Support\Facades\DB;

class Classroom extends Model
{
    protected $fillable = [
        'name',
        'schedule',
        'day',
        'size',
    ];

    public function getLeader(){
  		$leaders = DB::table('users')
  			->select('name', 'phone', 'user_classrooms.role')
            ->leftJoin('user_classrooms', 'users.id', '=', 'user_classrooms.user_id')
            ->where('user_classrooms.classroom_id', '=', $this->id)
            ->where('user_classrooms.role', '=', 'cc')
            ->where('user_classrooms.wait', '=', '0' )
            ->get();

    	return $leaders;
    }

    public function getLed(){
    	$leds = DB::table('users')
  			->select('name', 'phone', 'user_classrooms.role')
            ->leftJoin('user_classrooms', 'users.id', '=', 'user_classrooms.user_id')
            ->where('user_classrooms.classroom_id', '=', $this->id)
            ->where('user_classrooms.role', '=', 'cd')
            ->where('user_classrooms.wait', '=', '0' )
            ->get();


    	return $leds;
    }

    public function getStudentsNotInClassroom(){

        $inStudents = DB::table('user_classrooms')->select('user_id')->where('classroom_id', '=', $this->id)->get();

        $inStudentsPrepared = $this->prepareQueryResultToArray($inStudents);
        $studentsNotInClassroom = DB::table('users')->select('name','id')->whereNotIn('id',$inStudentsPrepared)->get();

        return $studentsNotInClassroom;

    }

    private function prepareQueryResultToArray($results){

        $inStudentsPrepared = [];

            foreach ($results as $result) {
                
                foreach ($result as $key => $value) {
                    $inStudentsPrepared[] = $value;
                }
            }

        return $inStudentsPrepared ;
    }
}
