<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DirectorController extends Controller
{
    public function index(Request $request){

    	$user = $request->user();

    	return view('directorHome', $user);
    }
}
