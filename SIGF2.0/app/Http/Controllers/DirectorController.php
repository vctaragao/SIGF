<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class DirectorController extends Controller
{
    public function index(Request $request){

    	$directors =  User::where('isDirector','1')->get();

    	$current_user = $request->user();

    	return view('directorHome', ['current_user' => $current_user, 'directors' => $directors]);
    }

    public function edit($director_id){

        $director = User::find($director_id);

        return view('director.edit', ['director' => $director]);
    }

    public function update(Request $data){

        $current_user = Auth::user();

        $validate = $data->validate([
            'email' => ['email','required', Rule::unique('users')->ignore($data->director_edit),],
            'cpf'   => [Rule::unique('users')->ignore($data->director_edit),],
        ]);

        $director = User::find($data->director_edit);

        if(Hash::check($data->password_confirmation, $current_user->password) && $validate){
            
            $director->name = $data->name;
            $director->sex = $data->sex;
            $director->email = $data->email;
            $director->phone = $data->phone;
            $director->cpf = $data->cpf;
            $director->course = $data->course;
            $director->colar = $data->colar;

            $result = $director->save();

            if ($result) {
                $data->session()->flash('success','Aluno editado com sucesso');
            }else{
                $data->session()->flash('error', 'Não foi possivel alterar informações');
            }
        }else{
            return redirect()->back()->with('error','Senha incorreta');
        }

        return redirect('/directorShow/'.$director->id);

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

    public function show($director_id){

        $director = User::find($director_id);

        return view('director.show', ['director' => $director]);
    }

    public function showAll(){

        $directors = User::where('isDirector', '=', 1)->get();

        return view('director.showAll',['directors' => $directors]);

    }

}
