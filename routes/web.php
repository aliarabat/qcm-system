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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/questions', 'QuestionController@create')->name('questions.create');
Route::Post('/questions/createQuestion', 'QuestionController@createQuestion')->name('questions.createQuestion');
Route::Get('/questions/findModuleByFiliere', 'QuestionController@findModuleByFiliere')->name('questions.findModuleByFiliere');
Route::Get('/questions/findChapitreByModule', 'QuestionController@findChapitreByModule')->name('questions.findChapitreByModule');


Route::get('/mainparts', 'MainPartsController@create')->name('mainParts.create');
Route::Get('/mainparts/modulesFiliere', 'MainPartsController@modulesFiliere')->name('mainParts.modulesFiliere');
Route::Post('/mainparts', 'MainPartsController@createNiveau')->name('mainParts.createNiveau');
Route::Post('/mainparts/filiere', 'MainPartsController@createFiliere')->name('mainParts.createFiliere');
Route::Post('/mainparts/module', 'MainPartsController@createModule')->name('mainParts.createModule');
Route::Post('/mainparts/chapitre', 'MainPartsController@createChapitre')->name('mainParts.createChapitre');





