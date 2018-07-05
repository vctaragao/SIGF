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

Route::middleware(['isDirector'])->group(function(){
	Route::get('/directorHome', 'DirectorController@index');
	Route::get('/directorRegister', 'DirectorController@register');
	Route::get('/addClassroom', 'ClassroomController@add');
	Route::post('/addClassroom', 'ClassroomController@create');
	Route::get('/addStudentToClassroom/{id}', 'ClassroomController@addStudent');
	Route::post('/addStudentToClassroom', 'UserClassroomController@insert');

});



Route::middleware(['isStudent'])->group(function(){
	Route::get('/studentHome', 'StudentController@index');
	Route::get('/studentEdit', 'StudentController@edit');
	Route::post('/studentEdit', 'StudentController@update');
});



Route::get('/professorHome', function(){
	return view('professorHome');
})->middleware('isProfessor');



