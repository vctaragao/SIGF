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

        return view('student.showAll', ['students' => $studentsNotInClassroom, 'flag' => $flag]);
    }

    public function insertStudentsInClassroom($id ,Request $request){
        
    }

    public function removeStudentsFromClassroom(){

    }

    public function addClass(){

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
