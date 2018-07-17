<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classroom;

class ProfessorController extends StudentController
{
    public function addStudentsToClassroom($classroom_id){

        $classroom = Classroom::find($classroom_id);
        $studentsNotInClassroom = $classroom->getStudentsNotInClassroom();

        $flag = 'add';

        return view('student.showAll', ['students' => $studentsNotInClassroom, 'flag' => $flag, 'classroom' => $classroom]);
    }

    public function insertStudentsToClassroom($classroom_id, Request $request){
        
        $classroom = Classroom::find($classroom_id);
        $result = $classroom->insertStudentAs($request->student_id, $request->role);

        if($result){

            return redirect('/classroom/'.$classroom_id)->with('success', 'Aluno adicionado com sucesso!');

        }else{

            return redirect('/addStudentToClassroom/'.$classroom_id)->with('error', 'Aconteceu algum erro, não foi possivel adicionar o aluno!');
        }

    }

    public function removeStudentsFromClassroom($classroom_id, $student_id){

        $classroom = Classroom::find($classroom_id);
        $result = $classroom->removeStudent($student_id);

        if($result){

            return redirect('/classroom/'.$classroom_id)->with('success', 'Aluno removido com sucesso!');

        }else{

            return redirect('/classroom/'.$classroom_id)->with('error', 'Aconteceu algum erro, não foi possivel remover o aluno!');
        }
    }

    public function addClass($classroom_id, Request $request){

        $classroom = Classroom::find($classroom_id);
        $students = $classroom->getStudentsInClassroom();

        if(!$students){
            $request->session->flash('error', 'Não foi possivel achar nenhum aluno');
        }

        return view('classroom.class.create', ['classroom' => $classroom, 'students' => $students]);
    }

    public function registerClass($classroom_id, Request $request){
        
        $classroom = Classroom::find($classroom_id);
        echo $request;
        echo "<br>";
        echo $classroom_id;
        die();
    }

    public function editClass(){

    }

    public function removeClass(){

    }

    public function addPresence(){

    }

    public function editPresence(){

    }

    public function removePresence(){

    }

    public function addClassContent(){

    }

    public function editClassContent(){

    }

    public function removeClassContent(){
    	
    }
}
