<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Classroom;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
}
