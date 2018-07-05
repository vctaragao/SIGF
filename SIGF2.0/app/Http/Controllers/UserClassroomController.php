<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User_Classroom;
use Illuminate\Support\Facades\DB;

class UserClassroomController extends Controller
{


	protected $IDS = [];

	protected function prepareJSON($json){

		foreach ($json as $key => $value) {

		    foreach ($value as $key2 => $value2) {

		        $this->IDS[] = $value2;

		    }
		}
	}

    public function insert(Request $request){
    		
    	$relation = new User_Classroom;

    	$relation->user_id = $request->user_id;
    	$relation->classroom_id = $request->classroom_id;
    	$relation->role = $request->role;
    	$relation->wait = '0';

    	$relation->save();

    	return redirect('/showClassroom/'.$request->classroom_id);
    }

    protected function getStudentsInClassroom($classroom_id){


    	$studentsID = DB::table('user_classrooms')
    							->select('user_id')
						    	->where('classroom_id', '=' , $classroom_id)
						    	->get();

    	return $studentsID;
    }

    public function getStudentsNotInClassroom($classroom_id){

    	$studentsID = DB::table('user_classrooms')
    							->select('user_id')
						    	->where('classroom_id', '=' , $classroom_id)
						    	->get();

        $this->prepareJSON($studentsID);

        $students = DB::table('users')->select('name','id')->whereNotIn('id', $this->IDS)->get();
        return $students;
    }

    public function getCondutores($classroom_id){

    	$studentsID = $this->getStudentsInClassroom($classroom_id);

    	$this->prepareJSON($studentsID);

    	$students = DB::table('users')
            ->join('user_classrooms', 'users.id', '=', 'user_classrooms.user_id')
            ->whereIn('users.id' , $this->IDS)
            ->where('user_classrooms.classroom_id', '=' , $classroom_id)
            ->where('user_classrooms.role', '=' ,'cc')
            ->select('users.id','users.name', 'user_classrooms.role')
            ->get();

            return $students;

    }

    public function getConduzidos($classroom_id){

    	$studentsID = $this->getStudentsInClassroom($classroom_id);

    	$this->prepareJSON($studentsID);

    	$students = DB::table('users')
            ->join('user_classrooms', 'users.id', '=', 'user_classrooms.user_id')
            ->whereIn('users.id' , $this->IDS)
            ->where('user_classrooms.classroom_id', '=' , $classroom_id)
            ->where('user_classrooms.role', '=' ,'cd')
            ->select('users.id','users.name', 'user_classrooms.role')
            ->get();

            return $students;

    }

}
