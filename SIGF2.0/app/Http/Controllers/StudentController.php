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


    public function edit(Request $request){

    	return view('student.edit');
    }

    public function update(Request $data){

    	$current_id = Auth::user()->id;

    	$validate = $data->validate([
    		'email' => ['email','required', Rule::unique('users')->ignore($current_id),],
    		'cpf'   => [Rule::unique('users')->ignore($current_id),],
    	]);

    	$user = User::find($current_id);

    	if(Hash::check($data->password_confirmation, $user->password) && $validate){
    		
    		$user->name = $data->name;
    		$user->sex = $data->sex;
    		$user->email = $data->email;
    		$user->phone = $data->phone;
    		$user->cpf = $data->cpf;
    		$user->course = $data->course;
    		$user->colar = $data->colar;

    		$user->save();
    	}

    	return redirect('/');

    }

    public function showAll(){

        $students = User::all();
        return $students;
    }

    public function getNamebyID($user_id){

        $students = DB::table('users')->select('name')->where('id', '=',  $user_id)->get();
        return $students;
    }



}
