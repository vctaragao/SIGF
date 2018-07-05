<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Classroom;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserClassroomController;
use App\User_Classroom;

class ClassroomController extends Controller
{
    public function index(){

    	$classrooms  = Classroom::all();

    	return view('classroomHome', ['classrooms'=> $classrooms]);
    }

    public function show($id){

    	$classroom = Classroom::find($id);
        $students = new UserClassroomController;
        $condutores = $students->getCondutores($id);
        $conduzidos = $students->getConduzidos($id);

    	return view('classroom.show', ['classroom' => $classroom, 'condutores' => $condutores, 'conduzidos' => $conduzidos]);
    }

    public function add(){

    	return view('classroom.create');
    }

    public function create(Request $request){


    	$validate = $request->validate([
    		'name' => 'required|unique:classrooms',
    		'schedule' => 'required',
    		'day' => 'required',
    		'size' => 'required',
    	]);


    	if($validate && Hash::check($request->password_confirmation, Auth::user()->password)){

    		$classroom = new Classroom;

            $classroom->name = $request->name;
            $classroom->schedule = $request->schedule;
            $classroom->day = $request->day;
            $classroom->size = $request->size;

            $classroom->save();

            return redirect('/Classrooms');

        }else{
        	$request->session()->flash('error', 'Senha incorreta!');
        	return redirect('/addClassroom');
        }

        

    }

    public function edit(){

    	// Show Classroom edit page

    }

    public function update(Request $request){

    	// Update classroom information

    }

    public function delete(Request $request){

    }


    public function addStudent($id){

    	$classroom = Classroom::find($id);

    	$students = new UserClassroomController;
    	$students = $students->getStudentsNotInClassroom($id);

    	return view('classroom.addstudent', ['students' => $students,'classroom' => $classroom]);
    }

}
