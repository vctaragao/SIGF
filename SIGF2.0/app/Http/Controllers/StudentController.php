<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Classroom;
use App\Classes;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{

    public function index(Request $request){

    	$current_student = $request->user();

    	return view('home',['current_student' => $current_student]);
    }

    public function edit($student_id){

        $user = User::find($student_id);

        return view('student.edit', ['user' => $user]);
    }

   public function update(Request $request){


        $validate = $request->validate([
            'name' => 'required|max:60',
            'email' => ['required','email', Rule::unique('users')->ignore($request->user_edit),],
            'sex' => 'required',
            'phone' => 'required|digits_between:10,20',
            'cpf' => 'required|digits:11',
            'course' => 'required|alpha',
            'course' => 'required|alpha',
        ]);

        $user = User::find($request->user_edit);

        if($validate && Hash::check($request->password_confirmation, $user->password)){

            $user->store($request);

            return redirect('/Home');

        }else{
            
            $request->session()->flash('error', 'Senha incorreta!');
            return redirect('/studentEdit/'.$user->id);
        }

   }

   public function seeAllStudents(){

        $students = User::all();

        return view('student.showAll', ['students' => $students]);

   }

   public function seeStudentInfo($student_id){


        $current_student = User::find($student_id);

        return view('student.info', ['current_student' => $current_student]);

   }

   public function seeAllClassrooms(){

        $classrooms = Classroom::all();

        return view('classroom.showAll',['classrooms' => $classrooms]);

   }

   public function seeClassroomInfo($classroom_id){

        $classroom = Classroom::find($classroom_id);

        $leaders = $classroom->getLeader();
        $leds = $classroom->getLed();

        return view('classroom.info', ['classroom' => $classroom, 'leaders' => $leaders, 'leds' => $leds]);
   }

   public function showClasses($classroom_id){

       $classes = Classes::where('classroom_id', '=', $classroom_id)->orderBy('date')->get();

       $classroom = Classroom::find($classroom_id);

       return view('classroom.class.showAll', ['classes' => $classes, 'classroom' => $classroom]);
   }

   public function showClassInfo($classroom_id, $class_id){

      $class = Classes::find($class_id);

      $presence = $class->attendence()->select('attendences.presence')->where('user_id', '=', Auth::id())->get();

      $classroom = Classroom::find($classroom_id);

      return view('classroom.class.info', ['class' => $class, 'classroom' => $classroom, 'presence' => $presence]);
   }

   public function seeAllDirectors(){

        $directors = User::where('isDirector', '=', 1)->get();

        return view('director.showAll', ['directors' => $directors]);
   }

   public function seeDirectorInfo($director_id){

        $director = User::find($director_id);

        return view('director.info', ['director' => $director]);

   }

   public function seeAllProfessors(){

        $professors = User::where('isProfessor', '=', 1)->get();

        return view('professor.showAll', ['professors' => $professors]);

   }

   public function seeProfessorInfo($professor_id){

        $professor = User::find($professor_id);

        return view('professor.info', ['professor' => $professor]);
   }

}
