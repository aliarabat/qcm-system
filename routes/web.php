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

//Questions
Route::get('/questions', 'QuestionController@create')->name('questions.create');
Route::post('/questions/creation', 'QuestionController@createQuestion')->name('questions.createQuestion');
Route::get('/questions/findModuleByFiliere', 'QuestionController@findModuleByFiliere')->name('questions.findModuleByFiliere');
Route::get('/questions/findChapitreByModule', 'QuestionController@findChapitreByModule')->name('questions.findChapitreByModule');
Route::get('/questions/edition', 'QuestionController@editQuestion')->name('questions.edit');
Route::get('/questions/validations', 'QuestionController@validateQuestions')->name('questions.validations');
Route::post('/questions/validate', 'QuestionController@changeValidation')->name('questions.changeValidation');

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
Route::Get('/mainparts/refreshNiveaux', 'MainPartsController@refreshNiveaux')->name('mainParts.refreshNiveaux');
Route::Post('/mainparts/{idModule}/updateModule', 'MainPartsController@updateModule')->name('mainParts.updateModule');
Route::Delete('/mainparts/{idModule}/deleteModule', 'MainPartsController@deleteModule')->name('mainParts.deleteModule');
Route::Post('/mainparts/{idChapitre}/updateChapitre', 'MainPartsController@updateChapitre')->name('mainParts.updateChapitre');
Route::Delete('/mainparts/{idChapitre}/deleteChapitre', 'MainPartsController@deleteChapitre')->name('mainParts.deleteChapitre');
Route::Get('/mainparts/refreshFilieres', 'MainPartsController@refreshFilieres')->name('mainParts.refreshFilieres');



//Evaluations routes
Route::get('/evaluations', 'EvaluationController@index')->name('evaluations.index');
Route::get('/evaluations/creation', 'EvaluationController@create')->name('evaluations.create');
Route::get('/evaluations/commencer', 'EvaluationController@start')->name('evaluations.start');
Route::post('/evaluations/terminer', 'EvaluationController@end')->name('evaluations.end');

//professors
Route::get('/professeurs', 'ProfessorController@index')->name('professors.index');
Route::post('/professeurs/creation', 'ProfessorController@create')->name('professors.create');


//students
Route::get('/etudiants', 'StudentController@index')->name('students.index');
Route::post('/etudiants/creation', 'StudentController@create')->name('students.creation');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
