<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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

    public function create(){

        // Create a director
    }

    public function edit(){

        // show page to edit director
    }

    public function update(){

        // Update director information
    }

}
