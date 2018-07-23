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
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{

    public function index(Request $request, $flag = null){

    	$current_student = $request->user();

      $openClassrooms = new Classroom;
      $openClassrooms = $openClassrooms->getOpenClassrooms();

      if(count($openClassrooms)){
        $flag = 'open';
      }else{
        $openClassrooms = null;
      }

    	return view('home',['current_student' => $current_student, 'flag' => $flag, 'classrooms' => $openClassrooms]);
    }

    public function edit($student_id){

        $user = User::find($student_id);

        if($user->id != Auth::user()->id && !Auth::user()->isDirector){
          return back();
        }

        return view('student.edit', ['user' => $user]);
    }

   public function update(Request $request){


        $validate = $request->validate([
            'name' => 'required|max:60',
            'email' => ['required','email', Rule::unique('users')->ignore($request->user_edit),],
            'sex' => 'required',
            'phone' => 'required|string:14,20',
            'cpf' => ['required', Rule::unique('users')->ignore($request->user_edit),],
            'course' => 'required',
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

   public function changePassword($user_id){

      return view('student.changePassword', ['user_id' => $user_id]);
   }

   public function registerNewPassword($user_id, Request $request){
      
      $validate = $request->validate([
          'password' => 'required|string|min:6|confirmed',
          'old_password' => 'required',
      ]);

      if(!Hash::check($request->old_password, Auth::user()->password)){
        return back()->with('error', 'Senha antiga não está correta');
      }

      $user = User::find($user_id);

      $user->password = Hash::make($request->password);

      $user->save();

      $request->session()->flash('success', 'Senha alterada com sucesso');

      return redirect('/Home');
   }

   public function seeAllStudents($flag = null){

        $students = User::all();

        return view('student.showAll', ['students' => $students, 'flag' => $flag]);

   }

   public function seeStudentInfo($student_id){


        $current_student = User::find($student_id);

        return view('student.info', ['current_student' => $current_student]);

   }

   public function seeAllClassrooms(){

        if(count($classrooms = Classroom::where('isOpen', '=', 1)->get())){
          $flag = 'open';
        }
        else{
          $flag = 'closed';
        }

        if(Auth::user()->isDirector || Auth::user()->isProfessor){

           $classrooms = Classroom::where('active', '=', 1)->get();

           return view('classroom.showAll',['classrooms' => $classrooms, 'flag' => $flag]);
        }

        $classrooms = new Classroom;

        $classrooms =  Auth::user()->classrooms()->select('user_classrooms.wait','classrooms.*', 'user_classrooms.role')->get();



        if(!count($classrooms)){
          return back()->with('subscription-status', 'Você não está matriculado em nenhuma turma');
        }

        return view('classroom.showAll',['classrooms' => $classrooms, 'flag' => $flag]);

   }

   public function seeClassroomInfo($classroom_id){

        $classroom = Classroom::find($classroom_id);

        $leaders = $classroom->getLeader();
        $leds = $classroom->getLed();

        return view('classroom.info', ['classroom' => $classroom, 'leaders' => $leaders, 'leds' => $leds]);
   }

   public function showClasses($classroom_id){

      $classes = new Classes;
      $classes = $classes->attendence()->where('classrooms.active', '=', 1)->where('classes.classroom_id', '=', $classroom_id)->orderBy('classes.date')->get();

      foreach ($classes as $class) {
        echo $class;
      }

      die();

       $classroom = Classroom::find($classroom_id);

       return view('classroom.class.showAll', ['classes' => $classes, 'classroom' => $classroom]);
   }

   public function showClassInfo($classroom_id, $class_id){

      $class = Classes::find($class_id);

      $presence = $class->attendence()->select('attendences.presence')->where('user_id', '=', Auth::id())->get();

      $classroom = Classroom::find($classroom_id);

      return view('classroom.class.info', ['class' => $class, 'classroom' => $classroom, 'presence' => $presence]);
   }

   public function seeAllDirectors($flag = null){

        $directors = User::where('isDirector', '=', 1)->get();

        return view('director.showAll', ['directors' => $directors, 'flag' => $flag]);
   }

   public function seeDirectorInfo($director_id){

        $director = User::find($director_id);

        return view('director.info', ['director' => $director]);

   }

   public function seeAllProfessors($flag = null){

        $professors = User::where('isProfessor', '=', 1)->get();

        return view('professor.showAll', ['professors' => $professors, 'flag' => $flag]);

   }

   public function seeProfessorInfo($professor_id){

        $professor = User::find($professor_id);

        return view('professor.info', ['professor' => $professor]);
   }

   public function classroomsSubscription(Request $request){

        $data = $request->all();

        if(!array_key_exists('role', $data)){

          return back()->with('subscription-error', 'Não selecionou os campos de papel na turma');

        }elseif(!array_key_exists('classrooms', $data)){

          return back()->with('subscription-error', 'Não selecionou a(s) turma(s) que deseja se inscrever');

        }elseif(!(!array_diff_key($data['role'], $data['classrooms']) && !array_diff_key($data['classrooms'], $data['role']))){

          return back()->with('subscription-error', 'Não selecionou os campos de papel e seleção de turma corretamente');

       }elseif(!Hash::check($request->password_confirmation, Auth::user()->password)){

          return back()->with('subscription-error', 'Senha incorreta');

       }

       foreach ($data['classrooms'] as $classroom_id => $value) {
            
            $data['classrooms'][$classroom_id] = 1;
       }


        foreach ($data['classrooms'] as $classroom_id => $value) {

            $classroom = Classroom::find($classroom_id);

            $result = $classroom->insertStudentAs($data['student_id'], $data['role'][$classroom_id]);

            if(!$result){
              return back()->with('subscription-error', 'Você já está matriculado na turma: '. $classroom->name);
            }
        }
      

        return back()->with('subscription-success','Inscrições realizadas com sucesso');

   }

}
