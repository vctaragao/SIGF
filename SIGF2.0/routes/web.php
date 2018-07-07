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

Route::get('/Classrooms', "ClassroomController@index");
Route::get('/showClassroom/{id}', 'ClassroomController@show');
Route::get('/studentShowAll', 'StudentController@showAll');
Route::get('/studentShow/{id}', 'StudentController@show');

Route::get('/directorShowAll', 'DirectorController@showAll');
Route::get('/directorShow/{id}', 'DirectorController@show');

Route::middleware(['isDirector'])->group(function(){


	// Routes for Director related actions
	Route::get('/directorHome', 'DirectorController@index');
	Route::get('/directorEdit/{id}', 'DirectorController@edit');
	Route::post('/directorEdit', 'DirectorController@update');
	Route::get('/directorDelete/{id}', 'DirectorController@delete');

	// Routes for Classroom related actions
	Route::get('/addClassroom', 'ClassroomController@add');
	Route::post('/addClassroom', 'ClassroomController@create');
	Route::get('/addStudentToClassroom/{id}', 'ClassroomController@addStudent');

	// Routes for Students related actions
	Route::get('/studentDelete/{id}', 'StudentController@delete');
	Route::get('/studentDelete', 'StudentController@showAllD');
	Route::get('/studentEdit', 'StudentController@edit');
	Route::get('/studentEdit/{id}', 'StudentController@edit');
	Route::post('/studentEdit', 'StudentController@update');
	Route::post('/addStudentToClassroom', 'UserClassroomController@insert');
	Route::get('/directorAdd', 'StudentController@showAllNotDirector');
	Route::get('/directorAdd/{id}', 'StudentController@addDirector');
	
	

});



Route::middleware(['isStudent'])->group(function(){
	Route::get('/studentHome', 'StudentController@index');
	Route::get('/studentEdit', 'StudentController@edit');
	Route::post('/studentEdit', 'StudentController@update');
});



Route::get('/professorHome', function(){
	return view('professorHome');
})->middleware('isProfessor');



