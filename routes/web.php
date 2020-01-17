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
Route::get('/questions', 'QuestionController@index')->name('questions.index');
Route::get('/questions/creation', 'QuestionController@create')->name('questions.create');
Route::post('/questions/store', 'QuestionController@store')->name('questions.store');
Route::get('/questions/findModuleByFiliere', 'QuestionController@findModuleByFiliere')->name('questions.findModuleByFiliere');
Route::get('/questions/findChapitreByModule', 'QuestionController@findChapitreByModule')->name('questions.findChapitreByModule');
Route::get('/questions/findPropositionsByQuestionId', 'QuestionController@findPropositionsByQuestionId')->name('questions.findPropositionsByQuestionId');
Route::get('/questions/findQuestionByChapitreId', 'QuestionController@findQuestionByChapitreId')->name('questions.findQuestionByChapitreId');
Route::get('/questions/validations', 'QuestionController@validateQuestions')->name('questions.validations');
Route::post('/questions/validate', 'QuestionController@changeValidation')->name('questions.changeValidation');
Route::post('/questions/voted', 'QuestionController@voted')->name('questions.voted');
Route::post('/questions/devoted', 'QuestionController@devoted')->name('questions.devoted');
Route::post('/questions/update', 'QuestionController@update')->name('questions.update');
Route::Delete('/questions/delete', 'QuestionController@deleteQuestionById')->name('questions.deleteQuestionById');
//mainParts
Route::get('/mainparts', 'MainPartsController@create')->name('mainParts.create');
Route::Get('/mainparts/modulesFiliere', 'MainPartsController@modulesFiliere')->name('mainParts.modulesFiliere');
Route::Post('/mainparts/chapitre', 'MainPartsController@createChapitre')->name('mainParts.createChapitre');
Route::Post('/mainparts/{idChapitre}/updateChapitre', 'MainPartsController@updateChapitre')->name('mainParts.updateChapitre');
Route::Delete('/mainparts/{idChapitre}/deleteChapitre', 'MainPartsController@deleteChapitre')->name('mainParts.deleteChapitre');
//Niveau
Route::get('/mainparts/niveau', 'NiveauController@showNiveau')->name('mainParts.niveau');
Route::Post('/mainparts/niveau', 'NiveauController@createNiveau')->name('mainParts.niveau.createNiveau');
Route::Post('/mainparts/niveau/{idNiveau}/updateNiveau', 'NiveauController@updateNiveau')->name('mainParts.niveau.updateNiveau');
Route::Delete('/mainparts/niveau/{idNiveau}/deleteNiveau', 'NiveauController@deleteNiveau')->name('mainParts.niveau.deleteNiveau');

//Filiere
Route::get('/mainparts/filiere', 'FiliereController@showFiliere')->name('mainParts.filiere');
Route::Post('/mainparts/filiere', 'FiliereController@createFiliere')->name('mainParts.filiere.createFiliere');
Route::Post('/mainparts/filiere/{idFiliere}/updateFiliere', 'FiliereController@updateFiliere')->name('mainParts.filiere.updateFiliere');
Route::Delete('/mainparts/filiere/{idFiliere}/deleteFiliere', 'FiliereController@deleteFiliere')->name('mainParts.filiere.deleteFiliere');

//Module
Route::get('/mainparts/module', 'ModuleController@showModule')->name('mainParts.module');
Route::get('/mainparts/module/semestresFiliere', 'ModuleController@semestresFiliere')->name('mainParts.module.semestresFiliere');
Route::Post('/mainparts/module', 'ModuleController@createModule')->name('mainParts.module.createModule');
Route::Post('/mainparts/module/{idModule}/updateModule', 'ModuleController@updateModule')->name('mainParts.module.updateModule');
Route::Delete('/mainparts/module/{idModule}/deleteModule', 'ModuleController@deleteModule')->name('mainParts.module.deleteModule');

//Chapitre
Route::get('/mainparts/chapitre', 'ChapitreController@showChapitre')->name('mainParts.chapitre');
Route::get('/mainparts/chapitre/modulesFiliere', 'ChapitreController@modulesFiliere')->name('mainParts.chapitre.modulesFiliere');
Route::Post('/mainparts/chapitre', 'ChapitreController@createChapitre')->name('mainParts.chapitre.createChapitre');
Route::Post('/mainparts/chapitre/{idChapitre}/updateChapitre', 'ChapitreController@updateChapitre')->name('mainParts.chapitre.updateChapitre');
Route::Delete('/mainparts/chapitre/{idChapitre}/deleteChapitre', 'ChapitreController@deleteChapitre')->name('mainParts.chapitre.deleteChapitre');



//Evaluations routes
Route::get('/evaluations', 'EvaluationController@index')->name('evaluations.index');
Route::get('/evaluations/creation', 'EvaluationController@create')->name('evaluations.create');
Route::post('/evaluations/passed/{qcmId}', 'EvaluationController@passed')->name('evaluations.passed');
Route::get('/evaluations/commencer/{id}', 'EvaluationController@start')->name('evaluations.start');
Route::Get('/Evaluation/findByModule', 'EvaluationController@findChapitreByModule')->name('evaluations.findChapitreByModule');
Route::Get('/Evaluation/findByFiliere', 'EvaluationController@findSemesterByFiliere')->name('evaluations.findSemesterByFiliere');
Route::Get('/Evaluation/findBySemestre', 'EvaluationController@findModuleBySemestre')->name('evaluations.findModuleBySemestre');
Route::post('/evaluations/terminer', 'EvaluationController@end')->name('evaluations.end');
Route::post('/evaluations/store', 'EvaluationController@store')->name('evaluations.store');
Route::get('/evaluations/resultats', 'EvaluationController@showResults')->name('evaluations.results');
Route::get('/evaluations/getResults', 'EvaluationController@getResults')->name('evaluations.getResults');
Route::get('/evaluations/countnote', 'EvaluationController@counteNote')->name('evaluations.countNote');
//professors
Route::get('/professeurs', 'ProfessorController@index')->name('professors.index');
Route::post('/professeurs/store', 'ProfessorController@store')->name('professors.store');
//QCM
Route::get('/qcm/creation', 'QcmController@index')->name('qcm.index');
Route::get('/qcm/findChapitreByModule', 'QcmController@findChapitreByModule')->name('qcm.findChapitreByModule');
Route::get('/qcm/create', 'QcmController@createQcm')->name('qcm.createQcm');
//students
Route::get('/etudiants', 'StudentController@index')->name('students.index');
Route::post('/etudiants/store', 'StudentController@store')->name('students.store');
//affectations students
Route::get('/affectation/etudiants', 'AffectationStudentController@index')->name('affectationStudent.index');
Route::post('/affectation/etudiants/store', 'AffectationStudentController@store')->name('affectationStudent.store');
Route::Delete('/affectation/etudiants/{idsemestre_student}/desafecterEtudiant', 'AffectationStudentController@desafecterEtudiant')->name('affectationStudent.desafecterEtudiant');

//affectations professors
Route::get('/affectation/professeurs', 'AffectationProfessorController@index')->name('affectationProfessor.index');
Route::post('/affectation/professeurs/store', 'AffectationProfessorController@store')->name('affectationProfessor.store');
Route::Get('/affectation/professeurs/filieresNiveau', 'AffectationProfessorController@filieresNiveau')->name('affectationProfessor.filieresNiveau');
Route::Get('/affectation/professeurs/semestresFiliere', 'AffectationProfessorController@semestresFiliere')->name('affectationProfessor.semestresFiliere');
Route::Get('/affectation/professeurs/modulesSemestre', 'AffectationProfessorController@modulesSemestre')->name('affectationProfessor.modulesSemestre');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
