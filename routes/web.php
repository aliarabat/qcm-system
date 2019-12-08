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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', 'HomeController@index')->name('home');

Route::get('/questions', 'QuestionController@create')->name('questions.create');
Route::post('/questions/createQuestion', 'QuestionController@createQuestion')->name('questions.createQuestion');
Route::get('/questions/findModuleByFiliere', 'QuestionController@findModuleByFiliere')->name('questions.findModuleByFiliere');
Route::get('/questions/findChapitreByModule', 'QuestionController@findChapitreByModule')->name('questions.findChapitreByModule');


Route::get('/mainparts', 'MainPartsController@create')->name('mainParts.create');
Route::get('/mainparts/modulesFiliere', 'MainPartsController@modulesFiliere')->name('mainParts.modulesFiliere');
Route::post('/mainparts', 'MainPartsController@createNiveau')->name('mainParts.createNiveau');
Route::post('/mainparts/filiere', 'MainPartsController@createFiliere')->name('mainParts.createFiliere');
Route::post('/mainparts/module', 'MainPartsController@createModule')->name('mainParts.createModule');
Route::post('/mainparts/chapitre', 'MainPartsController@createChapitre')->name('mainParts.createChapitre');

//Evaluations routes
Route::get('/evaluations', 'EvaluationController@index')->name('evaluations.index');
Route::get('/evaluations/start', 'EvaluationController@start')->name('evaluations.start');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
