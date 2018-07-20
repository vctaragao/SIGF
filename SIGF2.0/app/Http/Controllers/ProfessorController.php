<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classroom;
use App\Classes;
use App\Attendence;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


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

    public function registerClass(Request $request){

        $data = $request->all();


        $data['class_data']['date'] = $this->prepareDate($data['class_data']['date']);

        $validator = Validator::make($data, [
            'class_data.date' => 'required|date',
        ]);

        $attendece = new Attendence;
        $class = new Classes;

        $result = $class->create($data['class_data'], $request->classroom_id);

        if($result){
            
            $attendence = $attendece->create($data, $class->id);


            if($attendence){
                $request->session()->flash('success', 'Aula adicionada com sucesso');   
            }

        }else{
            
            $request->session()->flash('success', 'Não foi possivel adicionar a aula');
        }

        return redirect('/classroom/'.$request->classroom_id);
        
    }

    public function editClass($class_id){

        $class = Classes::find($class_id);
        $students = $class->getPresenceInTheClass();

        $class->date = date('d-m-Y', strtotime($class->date));
        $class->date = str_replace('-', '/',  $class->date);

        return view('classroom.class.edit', ['class' => $class, 'students' => $students]);        

    }

    public function updateClass(Request $request){

        $data = $request->all();

        $class = Classes::find($data['class_id']);

        $data['class_data']['date'] = $this->prepareDate($data['class_data']['date']);

        $result = $class->updateClass($data['class_data']);

        $attendence = new Attendence;

        $result2 = $attendence->updateAttendence($data);

        if($result && $result2){
            $request->session()->flash('success', 'Aula atualizada com sucesso');

        }else{
            $request->session()->flash('error', 'Não foi possível atualizar a aula');
        }

        return redirect('/showClassInfo/'.$class->classroom_id.'/'.$class->id);
    }

    public function removeClass(Request $request){

        $data = $request->all();    

        $class = Classes::find($request->class_id);
        $user = User::find($request->user_id);
        $attendence = new Attendence;

        if(Hash::check($request->confirm_password, $user->password) && $user->isProfessor){

           $result = $attendence->deletePresences($data['class_id']);


            if($result){

                $class->delete();

                $request->session()->flash('success', 'Aula excluida com sucesso');
            }else{
                $request->session()->flash('error', 'Não possivel excluir a aula.');
            }

            return redirect('/showClasses/'.$class->classroom_id);

        }else{
            return back()->with('error','Senha incorreta');
        }



    }

    protected function prepareDate($date){

        $date = str_replace('/', '-', $date);

        $date = date('Y-m-d', strtotime($date));

        return $date;
    }
}
