<?php

use App\Http\Controllers\AffectationProfessorController;
use App\Http\Controllers\AffectationStudentController;
use App\Http\Controllers\ChapitreController;
use App\Http\Controllers\CreateNiveauController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainPartsController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

//Questions
Route::prefix('questions')->group(function () {
    Route::get('/', [QuestionController::class, 'index'])
        ->name('questions.index');
    Route::get('/creation', [QuestionController::class, 'create'])
        ->name('questions.create');
    Route::post('/store', [QuestionController::class, 'store'])->name('questions.store');
    Route::get('/findModuleByFiliere', [QuestionController::class, 'findModuleByFiliere'])
        ->name('questions.findModuleByFiliere');
    Route::get('/findChapitreByModule', [QuestionController::class, 'findChapitreByModule'])
        ->name('questions.findChapitreByModule');
    Route::get('/findPropositionsByQuestionId', [QuestionController::class, 'findPropositionsByQuestionId'])
        ->name('questions.findPropositionsByQuestionId');
    Route::get('/findQuestionByChapitreId', [QuestionController::class, 'findQuestionByChapitreId'])
        ->name('questions.findQuestionByChapitreId');
    Route::get('/validations', [QuestionController::class, 'validateQuestions'])
        ->name('questions.validations');
    Route::post('/validate', [QuestionController::class, 'changeValidation'])
        ->name('questions.changeValidation');
    Route::post('/voted', [QuestionController::class, 'voted'])
        ->name('questions.voted');
    Route::post('/devoted', [QuestionController::class, 'devoted'])
        ->name('questions.devoted');
    Route::post('/update', [QuestionController::class, 'update'])
        ->name('questions.update');
    Route::delete('/delete', [QuestionController::class, 'deleteQuestionById'])
        ->name('questions.deleteQuestionById');
});
//mainParts
Route::prefix('mainparts')->group(function () {
    Route::get('/', [MainPartsController::class, 'create'])
        ->name('mainParts.create');
    Route::get('/modulesFiliere', [MainPartsController::class, 'modulesFiliere'])
        ->name('mainParts.modulesFiliere');
    Route::post('/chapitre', [MainPartsController::class, 'createChapitre'])
        ->name('mainParts.createChapitre');
    Route::post('/{idChapitre}/updateChapitre', [MainPartsController::class, 'updateChapitre'])
        ->name('mainParts.updateChapitre');
    Route::delete('/{idChapitre}/deleteChapitre', [MainPartsController::class, 'deleteChapitre'])
        ->name('mainParts.deleteChapitre');

    //Niveau
    Route::prefix('niveau')->group(function () {
        Route::get('/niveaux', [NiveauController::class, 'showNiveaux'])
            ->name('mainParts.niveau.niveaux');
        Route::get('/createNiveau', [CreateNiveauController::class, 'showCreateNiveau'])
            ->name('mainParts.niveau.createNiveau');
        Route::post('/createNiveau', [CreateNiveauController::class, 'create'])
            ->name('mainParts.niveau.createNiveau.create');
        Route::post('/niveaux/{idNiveau}/updateNiveau', [NiveauController::class, 'updateNiveau'])
            ->name('mainParts.niveau.updateNiveau');
        Route::delete('/niveaux/{idNiveau}/deleteNiveau', [NiveauController::class, 'deleteNiveau'])
            ->name('mainParts.niveau.deleteNiveau');
    });

    //Filiere
    Route::prefix('filiere')->group(function () {
        Route::get('/', [FiliereController::class, 'showFiliere'])
            ->name('mainParts.filiere');
        Route::post('/', [FiliereController::class, 'createFiliere'])
            ->name('mainParts.filiere.createFiliere');
        Route::post('/{idFiliere}/updateFiliere', [FiliereController::class, 'updateFiliere'])
            ->name('mainParts.filiere.updateFiliere');
        Route::delete('/{idFiliere}/deleteFiliere', [FiliereController::class, 'deleteFiliere'])
            ->name('mainParts.filiere.deleteFiliere');
    });

    //Module
    Route::prefix('module')->group(function () {
        Route::post('/', [ModuleController::class, 'createModule'])
            ->name('mainParts.module.createModule');
        Route::get('/', [ModuleController::class, 'showModule'])
            ->name('mainParts.module');
        Route::get('/semestresFiliere', [ModuleController::class, 'semestresFiliere'])
            ->name('mainParts.module.semestresFiliere');
        Route::post('/{idModule}/updateModule', [ModuleController::class, 'updateModule'])
            ->name('mainParts.module.updateModule');
        Route::delete('/{idModule}/deleteModule', [ModuleController::class, 'deleteModule'])
            ->name('mainParts.module.deleteModule');
    });

    //Chapitre
    Route::prefix('chapitre')->group(function () {
        Route::get('/', [ChapitreController::class, 'showChapitre'])
            ->name('mainParts.chapitre');
        Route::post('/', [ChapitreController::class, 'createChapitre'])
            ->name('mainParts.chapitre.createChapitre');
        Route::get('/modulesFiliere', [ChapitreController::class, 'modulesFiliere'])
            ->name('mainParts.chapitre.modulesFiliere');
        Route::post('/{idChapitre}/updateChapitre', [ChapitreController::class, 'updateChapitre'])
            ->name('mainParts.chapitre.updateChapitre');
        Route::delete('/{idChapitre}/deleteChapitre', [ChapitreController::class, 'deleteChapitre'])
            ->name('mainParts.chapitre.deleteChapitre');
    });
});


//Evaluations routes
Route::prefix('evaluations')->group(function () {
    Route::get('/', [EvaluationController::class, 'index'])
        ->name('evaluations.index');
    Route::get('/creation', [EvaluationController::class, 'create'])
        ->name('evaluations.create');
    Route::post('/passed/{qcmId}', [EvaluationController::class, 'passed'])
        ->name('evaluations.passed');
    Route::get('/commencer/{id}', [EvaluationController::class, 'start'])
        ->name('evaluations.start');
    Route::get('/findByModule', [EvaluationController::class, 'findChapitreByModule'])
        ->name('evaluations.findChapitreByModule');
    Route::get('/findByFiliere', [EvaluationController::class, 'findSemesterByFiliere'])
        ->name('evaluations.findSemesterByFiliere');
    Route::get('/findBySemestre', [EvaluationController::class, 'findModuleBySemestre'])
        ->name('evaluations.findModuleBySemestre');
    Route::post('/terminer', [EvaluationController::class, 'end'])
        ->name('evaluations.end');
    Route::post('/store', [EvaluationController::class, 'store'])
        ->name('evaluations.store');
    Route::get('/resultats', [EvaluationController::class, 'showResults'])
        ->name('evaluations.results');
    Route::get('/getResults', [EvaluationController::class, 'getResults'])
        ->name('evaluations.getResults');
    Route::get('/countnote', [EvaluationController::class, 'counteNote'])
        ->name('evaluations.countNote');
});
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

Route::prefix('affectation')->group(function () {
    //affectations students
    Route::get('/etudiants', [AffectationStudentController::class, 'index'])
        ->name('affectationStudent.index');
    Route::post('/etudiants/store', [AffectationStudentController::class, 'store'])
        ->name('affectationStudent.store');
    Route::delete('/etudiants/{idsemestre_student}/desafecterEtudiant', [AffectationStudentController::class, 'desafecterEtudiant'])
        ->name('affectationStudent.desafecterEtudiant');

    //affectations professors
    Route::prefix('professeurs')->group(function () {
        Route::get('/', [AffectationProfessorController::class, 'index'])
            ->name('affectationProfessor.index');
        Route::post('/store', [AffectationProfessorController::class, 'store'])
            ->name('affectationProfessor.store');
        Route::get('/filieresNiveau', [AffectationProfessorController::class, 'filieresNiveau'])
            ->name('affectationProfessor.filieresNiveau');
        Route::get('/semestresFiliere', [AffectationProfessorController::class, 'semestresFiliere'])
            ->name('affectationProfessor.semestresFiliere');
        Route::get('/modulesSemestre', [AffectationProfessorController::class, 'modulesSemestre'])
            ->name('affectationProfessor.modulesSemestre');
    });
});

Auth::routes();

Route::get('showRegistrationForm', fn () => redirect()->route('home'));
// Route::post('register', fn () => abort(403));
