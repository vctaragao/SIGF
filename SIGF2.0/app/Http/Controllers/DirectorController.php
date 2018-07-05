<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class DirectorController extends Controller
{
    public function index(Request $request){

    	$directors =  User::where('isDirector','1')->get();

    	$current_user = $request->user();

    	return view('directorHome', ['current_user' => $current_user, 'directors' => $directors]);
    }

    public function register(){

    	return view('director.register');
    }

    public function create(Request $request){
        // Create a director
            $validate = $request->validate([
                'name' => 'required|string|',
                'email' => 'unique:users|email',
                'cpf'   => 'unique:users|digits_between:5,25',
                'sex'   =>  'required',
                'phone' =>  'required|digits_between:8,16',
                'course' => 'required',
                'colar' => 'required|',
            ]);


            if($validate && $request->password_confirmation == $request->password){

                $director = new User;

                $director->name = $request->name;
                $director->email = $request->email;
                $director->cpf = $request->cpf;
                $director->sex = $request->sex;
                $director->phone = $request->phone;
                $director->course = $request->course;
                $director->colar = $request->colar;
                $director->password = Hash::make($request->password);
                $director->isDirector = '1';

                $director->save();

                $request->session()->flash('success','Diretor adicionado com sucesso');

                return redirect('/directorShowAll');

            }else{
                $request->session()->flash('error', 'Senha incorreta!');
                return redirect('/addClassroom');
            }

            

    }

    public function edit(){

        // show page to edit director
    }

    public function update(){

        // Update director information
    }

    public function delete($director_id, Request $request){

        $director = User::find($director_id);

        $director->isDirector = '0';

        $director->save();

        if($director->isDirector){
            $request->session()->flash('erro', 'Não foi possivel remover o diretor');
        }else{
            $request->session()->flash('success', 'Diretor removido com sucesso');
        }

        return redirect('/directorShowAll');
    }

    public function showAll(){

        $directors = User::where('isDirector', '=', 1)->get();

        return view('director.show',['directors' => $directors]);

    }

}
