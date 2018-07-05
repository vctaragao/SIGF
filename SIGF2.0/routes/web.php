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

Route::middleware(['isDirector'])->group(function(){
	Route::get('/directorHome', 'DirectorController@index');
	Route::get('/directorRegister', 'DirectorController@register');
	Route::post('/directorRegister', 'DirectorController@create');
	Route::get('/addClassroom', 'ClassroomController@add');
	Route::post('/addClassroom', 'ClassroomController@create');
	Route::get('/addStudentToClassroom/{id}', 'ClassroomController@addStudent');
	Route::post('/addStudentToClassroom', 'UserClassroomController@insert');
	Route::get('/directorShowAll', 'DirectorController@showAll');
	Route::get('/directorDelete/{id}', 'DirectorController@delete');
	Route::get('/studentDelete/{id}', 'StudentController@delete');
	Route::get('/studentDelete', 'StudentController@showAllD');

});



Route::middleware(['isStudent'])->group(function(){
	Route::get('/studentHome', 'StudentController@index');
	Route::get('/studentEdit', 'StudentController@edit');
	Route::post('/studentEdit', 'StudentController@update');
});



Route::get('/professorHome', function(){
	return view('professorHome');
})->middleware('isProfessor');



