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

//mainParts
Route::get('/mainparts', 'MainPartsController@create')->name('mainParts.create');
Route::Get('/mainparts/modulesFiliere', 'MainPartsController@modulesFiliere')->name('mainParts.modulesFiliere');
Route::Post('/mainparts', 'MainPartsController@createNiveau')->name('mainParts.createNiveau');
Route::Post('/mainparts/filiere', 'MainPartsController@createFiliere')->name('mainParts.createFiliere');
Route::Post('/mainparts/module', 'MainPartsController@createModule')->name('mainParts.createModule');
Route::Post('/mainparts/chapitre', 'MainPartsController@createChapitre')->name('mainParts.createChapitre');
Route::Post('/mainparts/{idNiveau}/updateNiveau', 'MainPartsController@updateNiveau')->name('mainParts.updateNiveau');
Route::Delete('/mainparts/{idNiveau}/deleteNiveau', 'MainPartsController@deleteNiveau')->name('mainParts.deleteNiveau');
Route::Post('/mainparts/{idFiliere}/updateFiliere', 'MainPartsController@updateFiliere')->name('mainParts.updateFiliere');
Route::Delete('/mainparts/{idFiliere}/deleteFiliere', 'MainPartsController@deleteFiliere')->name('mainParts.deleteFiliere');








Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
