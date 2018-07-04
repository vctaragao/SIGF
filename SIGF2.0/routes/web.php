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

Route::get('/', 'PagesController@index')->middleware('checkRole');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('checkRole');

Route::get('/directorHome', 'DirectorController@index')->middleware('isDirector');

Route::get('/studentHome', function(){
	return view('studentHome');
})->middleware('isStudent');;

Route::get('/professorHome', function(){
	return view('professorHome');
})->middleware('isProfessor');;


