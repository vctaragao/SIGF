<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'PagesController@index')->middleware('guest');

Route::get('/home', 'HomeController@index')->name('home')->middleware('guest');



Route::middleware(['isDirector'])->group(function(){
		
});



Route::middleware(['isStudent'])->group(function(){

	Route::get('/Home', 'StudentController@index');
	Route::get('/studentEdit/{id}', 'StudentController@edit');
	Route::post('/studentEdit', 'StudentController@update');
	Route::get('/studentAll', 'StudentController@seeAllStudents');
	Route::get('/student/{id}', 'StudentController@seeStudentInfo');
	Route::get('/classroomAll', 'StudentController@seeAllClassrooms');
	Route::get('/classroom/{id}', 'StudentController@seeClassroomInfo');
	Route::get('/professorAll', 'StudentController@seeAllProfessors');
	Route::get('professor/{id}', 'StudentController@seeProfessorInfo');
	Route::get('/directorAll', 'StudentController@seeAllDirectors');
	Route::get('/director/{id}', 'StudentController@seeDirectorInfo');
	Route::get('/showClasses/{id}', 'StudentController@showClasses');
	Route::get('/showClassInfo/{classroom_id}/{id}', 'StudentController@showClassInfo');

});


Route::middleware(['isProfessor'])->group(function(){

	Route::get('/addStudentToClassroom/{id}', 'ProfessorController@addStudentsToClassroom');
	Route::post('/addStudentToClassroom/{id}', 'ProfessorController@insertStudentsToClassroom');
	Route::get('/removeStudentFromClassroom/{classroom_id}/{id}', 'ProfessorController@removeStudentsFromClassroom');
	Route::get('/addClassToClassroom/{id}', 'ProfessorController@addClass');
	Route::post('/addClassToClassroom', 'ProfessorController@registerClass');
	Route::get('/classEdit/{id}', 'ProfessorController@editclass');
	Route::post('/classEdit', 'ProfessorController@updateClass');
	Route::post('/removeClass', 'ProfessorController@removeClass');
});

