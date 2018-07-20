<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User_Classroom;
use App\User;
use Illuminate\Support\Facades\DB;

class Classroom extends Model
{
    protected $fillable = [
        'name',
        'schedule',
        'day',
        'size',
    ];


    public function users(){

        return $this->belongsToMany('App\User', 'user_classrooms');
    }

    public function classes(){
        
        return $this->hasMany('App\Class');
    }

    public function create($request){

        $this->name = $request->name;
        $this->schedule = $request->schedule;
        $this->day = $request->day;
        $this->size = $request->size;

        $result = $this->save();

        return ($result) ? true : false;
    }

    public function updateClassroom($request){

        $this->name = $request->name;
        $this->schedule = $request->schedule;
        $this->day = $request->day;
        $this->size = $request->size;

        $result = $this->save();

        return ($result) ? true : false;

    }

    public function removeClassroom(){

       $this->active = 0;

       $result = $this->save();

       return ($result) ? true : false;
    }

    public function insertStudentAs($student_id, $role){



        $relation = new User_Classroom;

        $relation->user_id = $student_id;
        $relation->classroom_id = $this->id;
        $relation->role = $role;
        $relation->wait = 0;

        $result = $relation->save();

        return ($result) ? true : false;
        
    }

    public function removeStudent($student_id){


        $student = User_Classroom::where('classroom_id', '=', $this->id)
                                    ->where('user_id', '=', $student_id)
                                    ->delete();

        return ($student) ? true : false;
    }

    public function getLeader(){

        $leaders = $this->users()->select('users.id','name','phone')
                                ->where('user_classrooms.classroom_id', '=', $this->id)
                                ->where('user_classrooms.role', '=', 'cc')
                                ->where('user_classrooms.wait', '=', '0' )
                                ->orderBy('name')
                                ->get();

    	return $leaders;
    }

    public function getLed(){
    	$leds = DB::table('users')
  			->select('users.id','name', 'phone', 'user_classrooms.role')
            ->leftJoin('user_classrooms', 'users.id', '=', 'user_classrooms.user_id')
            ->where('user_classrooms.classroom_id', '=', $this->id)
            ->where('user_classrooms.role', '=', 'cd')
            ->where('user_classrooms.wait', '=', '0' )
            ->orderBy('name')
            ->get();


    	return $leds;
    }

    public function getStudentsNotInClassroom(){

        $inStudents = DB::table('user_classrooms')->select('user_id')->where('classroom_id', '=', $this->id)->get();

        $inStudentsPrepared = $this->prepareQueryResultToArray($inStudents);
        $studentsNotInClassroom = DB::table('users')->select('name','id')->whereNotIn('id',$inStudentsPrepared)->get();

        return $studentsNotInClassroom;

    }

    public function getStudentsInCLassroom(){
        
        $students = $this->users()->select('users.id', 'name')->where('user_classrooms.classroom_id', '=', $this->id)->orderBy('name')->get();

        return $students;

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
