<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Classroom;
use App\Attendence;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use PDF;

class DirectorController extends StudentController
{
    public function createClassroom(){

        return view('classroom.create');
    }

    public function insertClassroom(Request $request){

        $validation = $request->validate([
            'name' => 'required|string|max:255',
            'schedule' => 'required',
            'day' => 'required|string',
            'size' => 'numeric|nullable',

        ]);

        if($validation && Hash::check($request->password_confirmation, Auth::user()->password)){

            $classroom = new Classroom;
            $result = $classroom->create($request);

            if(!$result){

               return back()->with('error','Não foi possivel criar a turma');

            }

            $request->session()->flash('success', 'Turma criada com sucesso');
            return redirect('/classroomAll');

        }else{
            return back()->with('error', 'Senha incorreta');
        }
    }

    public function editClassroom($classroom_id){

        $classroom = Classroom::find($classroom_id);

        return view('classroom.edit', ['classroom' => $classroom]);
    }

    public function updateClassroom(Request $request){

        $validation = $request->validate([
            'name' => 'required|string|max:255',
            'schedule' => 'required',
            'day' => 'required|string',
            'size' => 'numeric|nullable',

        ]);

        if($validation && Hash::check($request->password_confirmation, Auth::user()->password)){

            $classroom = Classroom::find($request->classroom_id);
            $result = $classroom->updateClassroom($request);

            if(!$result){

               return back()->with('error','Não foi possivel alterar a turma');

            }

            $request->session()->flash('success', 'Turma alterada com sucesso');
            return redirect('/classroom/'.$classroom->id);

        }else{
            return back()->with('error', 'Senha incorreta');
        }
    }

    public function removeClassroom(Request $request){

        $classroom = Classroom::find($request->classroom_id);

        $result = $classroom->removeClassroom();

        if(!$result){
            return back()->with('error', 'Não foi possivel excluir a turma');
        }

        return redirect('/classroomAll')->with('success', 'Turma removida com sucesso!');

    }

    public function addDirector(){

        $directors = new User;

        $students = $directors->getNotDirectors();

        $flag = "director";

        return view('student.showAll', ['students' => $students, 'flag' => $flag]);

    }

    public function registerDirector($user_id){

        $student = User::find($user_id);

        $result = $student->becomeDirector();

        if(!$result){
            return back()->with('error', 'Não foi possivel adicionar diretor');
        }

        return back()->with('success','Diretor adicionado com sucesso');
    }

    public function removeDirector(){

        $flag = 'remove';

        return $this->seeAllDirectors($flag);
    }

    public function deleteDirector($director_id){

        $director = User::find($director_id);

        $result = $director->removeDirector();

         if(!$result){
            return back()->with('error', 'Não foi possivel remover diretor');
        }

        return back()->with('success','Diretor removido com sucesso');
    }

    public function addProfessor(){

        $professors = new User;

        $students = $professors->getNotProfessors();

        $flag = "professor";

        return view('student.showAll', ['students' => $students, 'flag' => $flag]);

    }

    public function registerProfessor($user_id){

        $user = User::find($user_id);

        $result = $user->becomeProfessor();

        if(!$result){
            return back()->with('error', 'Não foi possivel adicionar professor');
        }

        return back()->with('success','Professor adicionado com sucesso');
    }

    public function removeProfessor(){

        $flag = "remove";

        return $this->seeAllProfessors($flag);
    }

    public function deleteProfessor($professor_id){

        $professor = User::find($professor_id);

        $result = $professor->removeProfessor();

         if(!$result){
            return back()->with('error', 'Não foi possivel remover professor');
        }

        return back()->with('success','Professor removido com sucesso');
    }

    public function seeOpenClassrooms($flag = null){

        $openClassrooms = new Classroom;

        $openClassrooms = $openClassrooms->getOpenClassrooms();

        if(!count($openClassrooms)){
            return back()->with('subscription-status','Nenhuma turma está aberta para inscrição');
        }

        return view('subscription.showAll', ['classrooms' => $openClassrooms, 'flag' => $flag]);

   }

   public function openClassrooms(){

        $closedClassrooms = new Classroom;

        $closedClassrooms = $closedClassrooms->getClosedClassrooms();

        if(!count($closedClassrooms)){
            return back()->with('subscription-status','Nenhuma turma está sujeita a ser aberta para inscrição');
        }

        $flag = 'open';


        return view('subscription.showAll', ['classrooms' => $closedClassrooms, 'flag' => $flag]);
   }

   public function registerOpenClassrooms(Request $request){

        $data = $request->all();

         if(empty($data['classrooms'])){
            return back()->with('error', 'Não foi selecionada nenhuma turma');
        }


        foreach ($data['classrooms'] as $key => $value) {
            if($value == 'on'){
                $data['classrooms'][$key] = 1;
            }

        }

        if(!Hash::check($request->password_confirmation, Auth::user()->password)){

            return back()->with('error', 'Senha incorreta');

        }


        foreach ($data['classrooms'] as $classroom_id => $open) {

            $classroom = Classroom::find($classroom_id);

            $classroom->openClassroom($open);
        }

        $request->session()->flash('subscription-status', 'Turmas abertas com sucesso');

        return redirect('/home');
   }

   public function closeClassrooms(){

        return $this->seeOpenClassrooms('close');
   }

   public function registerClosedClassrooms(Request $request){

        $data = $request->all();

        if(empty($data['classrooms'])){
            return back()->with('error', 'Não foi selecionada nenhuma turma');
        }

        foreach ($data['classrooms'] as $key => $value) {
            if($value == 'on'){
                $data['classrooms'][$key] = 0;
            }

        }

        if(!Hash::check($request->password_confirmation, Auth::user()->password)){

            return back()->with('error', 'Senha incorreta');

        }


        foreach ($data['classrooms'] as $classroom_id => $close) {

            $classroom = Classroom::find($classroom_id);

            $classroom->closeClassroom($close);
        }

        $request->session()->flash('subscription-status', 'Turmas fechadas com sucesso');

        return redirect('/home');
   }

   public function putOnWait($classroom_id, $student_id){

        $classroom = Classroom::find($classroom_id);

        $classroom->putOnQueue($student_id);

        return back();
   }

   public function putOffWait($classroom_id,$student_id){

        $classroom = Classroom::find($classroom_id);

        $result = $classroom->putOffQueue($student_id);

        if(!$result){
            return back()->with('error', 'Turma cheia!');
        }
        return back();
   }

   public function deleteStudent($student_id){

        $user = User::find($student_id);

        $user->delete();

        return back()->with('success', 'Estudante removido com sucesso');
   }

   public function removeStudent(){

        $students = User::all();

        $flag = "remove";

        return view('student.showAll', ['students' => $students, 'flag' => $flag]);

   }

   public function getStudentHours(){

     $users = User::all()->sortBy('name');
     // echo $users;
     // die();
     $user_data = [];
     $hours = 0;

     foreach ($users as $user) {
       // Pegar as turmas que o aluno está inscrito e que estão ativas
       $classrooms = $user->classrooms->where('active',1);

       // Se o aluno não está matriculado em nenhuma turma ativa, passar para o próximo
       if(!count($classrooms))
        continue;

       // Pegar as aulas dessas turmas
       foreach($classrooms as $classroom){
         $classes = $classroom->classes;

         //Pegar a presença dessas aulas do aluno especifico
         foreach ($classes as $class)
           $hours += count(Attendence::all()->where('user_id',$user->id)->where('class_id', $class->id)->where('presence',1)) * 2;
         }

       $user_data[] = ['user_name' => $user->name, 'hours' => $hours, 'user_cpf' => $user->cpf];
       $hours = 0;
     }

    // Carregar e baixar o arquivo PDF 
    $pdf = PDF::loadView('pdf.studentHours',['user_data' => $user_data]);
    return $pdf->download('studentHours.pdf');

   }
}
