<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index(Request $request){

    	$current_student = $request->user();

    	return view('studentHome',compact('current_student'));
    }


    public function edit($user_id){

        $user = User::find($user_id);

    	return view('student.edit', ['user' => $user]);
    }

    public function update(Request $data){

    	$current_user = Auth::user();

    	$validate = $data->validate([
    		'email' => ['email','required', Rule::unique('users')->ignore($data->user_edit),],
    		'cpf'   => [Rule::unique('users')->ignore($data->user_edit),],
    	]);

    	$student = User::find($data->user_edit);

    	if(Hash::check($data->password_confirmation, $current_user->password) && $validate){
    		
    		$student->name = $data->name;
    		$student->sex = $data->sex;
    		$student->email = $data->email;
    		$student->phone = $data->phone;
    		$student->cpf = $data->cpf;
    		$student->course = $data->course;
    		$student->colar = $data->colar;

    		$result = $student->save();

            if ($result) {
                $data->session()->flash('success','Aluno editado com sucesso');
            }else{
                $data->session()->flash('error', 'Não foi possivel alterar informações');
            }
    	}else{
            return redirect()->back()->with('error','Senha incorreta');
        }

    	return redirect('/studentShow/'.$student->id);

    }

    public function show($user_id){

        $student = User::find($user_id);

        return view('student.show', ['student' => $student]);
    }

    public function showAll(){

        $students = User::all();

        $flag = '';

        return view('student.showAll',['students' => $students, 'flag' => $flag]);
    }

    public function showAllD(){

        $students = User::all();
        return view('student.delete', ['students' => $students]);
    }

    public function showAllNotDirector(){

        $flag = 'add';

        $students = User::where('isDirector', '=', '0')->get();

        return view('student.showAll', ['students' => $students, 'flag' => $flag]);
    }

    public function addDirector($student_id){

        $student = User::find($student_id);

        $student->isDirector = '1';

        $result = $student->save();

        if($result){
            return redirect()->back()->with('success', 'Diretor adicionado com sucesso');
        }else{
            return redirect()->back()->with('error', 'Não foi possivel adicionar diretor');
        }
    }

    public function delete($student_id, Request $request){
        
        $student = User::find($student_id);
        

        $student->delete();

        if($student){
            $request->session()->flash('erro', 'Não foi possivel remover o diretor');
        }else{
            $request->session()->flash('success', 'Diretor removido com sucesso');
        }

        return redirect('/studentShowAll');
    }

    public function getNamebyID($user_id){

        $students = DB::table('users')->select('name')->where('id', '=',  $user_id)->get();
        return $students;
    }



}
