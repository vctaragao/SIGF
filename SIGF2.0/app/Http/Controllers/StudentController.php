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

   public function update(){

   }

   public function seeAllStudents(){

   }

   public function seeAllClassrooms(){

   }

   public function seeClassroomInfo(){

   }

   public function seeAllDirectors(){

   }

   public function seeDirectorInf(){

   }

   public function seeAllProfessors(){

   }

   public function seeProfessorInfo(){
    
   }

}
