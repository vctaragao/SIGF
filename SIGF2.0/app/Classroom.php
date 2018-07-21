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

        $wait = 0;

        if($this->isStudentInClassroom($student_id)){ 
            return false;
        }elseif($this->inQueue($role)){
            $wait = 1;
        }


        $relation = new User_Classroom;

        $relation->user_id = $student_id;
        $relation->classroom_id = $this->id;
        $relation->role = $role;
        $relation->wait = $wait;

        $relation->save();

        return true;
        
    }

    protected function isStudentInClassroom($student_id){

        $student = $this->users()->where('user_classrooms.user_id', '=', $student_id)->get();

        return (count($student)) ? true : false;
    }

    protected function inQueue($role){

        if($role == 'cc'){
            $students = $this->getLeader();
        }elseif($role == 'cd'){
            $students = $this->getLed();
        }

        if(count($students) >= ($this->size/2)){
            return true;
        }

        return false;
    }

    public function removeStudent($student_id){


        $student = User_Classroom::where('classroom_id', '=', $this->id)
                                    ->where('user_id', '=', $student_id)
                                    ->delete();

        return ($student) ? true : false;
    }

    public function getLeader(){

        $leaders = $this->users()->select('users.id','name','phone','user_classrooms.wait')
                                ->where('user_classrooms.classroom_id', '=', $this->id)
                                ->where('user_classrooms.role', '=', 'cc')
                                ->orderBy('user_classrooms.wait')
                                ->get();

    	return $leaders;
    }

    public function getLed(){
    	$leds = DB::table('users')
  			->select('users.id','name', 'phone', 'user_classrooms.role', 'user_classrooms.wait')
            ->leftJoin('user_classrooms', 'users.id', '=', 'user_classrooms.user_id')
            ->where('user_classrooms.classroom_id', '=', $this->id)
            ->where('user_classrooms.role', '=', 'cd')
            ->orderBy('user_classrooms.wait')
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

    public function getOpenClassrooms(){

        return $this->where('isOpen', '=', 1)->where('active', '=', 1)->get();
    }

    public function getClosedClassrooms(){

        return $this->where('isOpen', '=', 0)->where('active', '=', 1)->get();
    }

    public function openClassroom($open){

        $this->isOpen = $open;

        $result = $this->save();

        return ($result) ? true : false;
    }

    public function closeClassroom($close){

        $this->isOpen = $close;

        $result = $this->save();

        return ($result) ? true : false;
    }

    public function putOnQueue($student_id){

        $user = User_Classroom::where('user_id' , '=', $student_id)->where('classroom_id', '=', $this->id)->get();

        $user = User_Classroom::find($user[0]->id);

        $user->wait = 1;
        $user->save();

        return true;
    }

    public function putOffQueue($student_id){

        $user = User_Classroom::where('user_id' , '=', $student_id)->where('classroom_id', '=', $this->id)->get();

        if($this->isClassroomFull($user[0]->role)){
            return false;
        }


        $user = User_Classroom::find($user[0]->id);

        $user->wait = 0;
        $user->save();
        $user->created_at = $user->updated_at;
        $user->save(); 

        return true;
    }

    protected function isClassroomFull($role){

        if($role == 'cc'){

            $leaders = $this->getLeadersInClassroom();
            return (count($leaders) < ($this->size/2)) ? false : true;

        }elseif($role == 'cd'){

            $leds = $this->getLedsInClassroom();
            return (count($leds) < ($this->size/2)) ? false : true;

        }

        
    }

    private function getLeadersInClassroom(){
        $leaders = $this->users()->select('users.id','name','phone','user_classrooms.wait')
                                ->where('user_classrooms.classroom_id', '=', $this->id)
                                ->where('user_classrooms.role', '=', 'cc')
                                ->where('user_classrooms.wait', '=', 0)
                                ->orderBy('user_classrooms.updated_at')
                                ->get();

        return $leaders;
    }

    private function getLedsInClassroom(){
        $leds = DB::table('users')
            ->select('users.id','name', 'phone', 'user_classrooms.role', 'user_classrooms.wait')
            ->leftJoin('user_classrooms', 'users.id', '=', 'user_classrooms.user_id')
            ->where('user_classrooms.classroom_id', '=', $this->id)
            ->where('user_classrooms.role', '=', 'cd')
            ->where('user_classrooms.wait', '=', 0)
            ->orderBy('user_classrooms.updated_at')
            ->get();


        return $leds;
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
