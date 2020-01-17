<?php

namespace App\Http\Controllers;

use App\Filiere;
use App\Module;
use App\Semestre;
use App\semestreModule;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    //
    private $allAssocSemestreModules;
    private $filieres;


    public function showModule()
    {
        $this->allAssocSemestreModules = semestreModule::all();
        $this->filieres = Filiere::all();
        return view(
            'mainparts.module',
            ['assocSemestreModule' => $this->allAssocSemestreModules, 'filieres' => $this->filieres]
        );
    }

    public function semestresFiliere(Request $request)
    {
        $this->validate($request, ['nom_filiere' => 'required|exists:filieres,nom_filiere']);
        $filiereExistant = Filiere::get()->where('nom_filiere', mb_strtoupper($request->get('nom_filiere')))->first();
        $semestresFiliere = Semestre::get()->where('filiere_id', $filiereExistant->id);
        $data = array();
        foreach ($semestresFiliere as $semestre) {
            array_push($data, $semestre);
        }
        $semestresData['data'] = $data;
        return json_encode($semestresData);
    }

    //Création d'un nouveau module

    public function createModule(Request $request)
    {
        $moduleExistant = Module::get()->where('nom_module', mb_strtoupper($request->input('nom_module')))->first();
        if ($moduleExistant) {
            $selectFiliere = $request->input('filiereModule');
            $infosFiliere = explode("-", $selectFiliere);
            $filiereExistant = Filiere::get()->where('nom_filiere', mb_strtoupper($infosFiliere[0]))->first();
            //$filiereExistant = Filiere::get()->where('id',intval($selectFiliere) )->first();
            $selectedSemestre = $request->input('semestreFiliere');
            $semestreExistant = Semestre::get()->where('libelle', $selectedSemestre)->where('filiere_id', $filiereExistant->id)->first();
            $assocSemestreModule = semestreModule::get()->where('semestre_id', $semestreExistant->id)->where('module_id', $moduleExistant->id)->first();
            if ($assocSemestreModule) {
                $messagePane = 'Ce module est déjà associé à cette filière pour un semestre';
                return $messagePane;
            } else {
                //$semestreId = $semestreExistant->id;
                //$moduleId=$moduleExistant->id;
                $assocSemestreModuleNew = new semestreModule();
                $assocSemestreModuleNew->semestre()->associate($semestreExistant);
                $assocSemestreModuleNew->module()->associate($moduleExistant);
                $assocSemestreModuleNew->save();
                $messagePane = 'Ce module a été associé à cette filière';
                return $messagePane;


            }
        } else {
            $module = new Module();
            $module->nom_module = mb_strtoupper($request->input('nom_module'));
            $module->libelle = mb_strtoupper($request->input('libelleModule'));
            $module->save();
            $selectFiliere = $request->input('filiereModule');
            $infosFiliere = explode("-", $selectFiliere);
            $filiereExistant = Filiere::get()->where('nom_filiere', mb_strtoupper($infosFiliere[0]))->first();
            //$filiereExistant = Filiere::get()->where('id',intval($selectFiliere) )->first();
            $selectedSemestre = $request->input('semestreFiliere');
            $semestreExistant = Semestre::get()->where('libelle', $selectedSemestre)->where('filiere_id', $filiereExistant->id)->first();
            $moduleExistant = Module::get()->where('nom_module', mb_strtoupper($request->input('nom_module')))->first();
            //$semestreId = $semestreExistant->id;
            //$moduleId=$moduleExistant->id;
            $assocSemestreModuleNew = new semestreModule();
            $assocSemestreModuleNew->semestre()->associate($semestreExistant);
            $assocSemestreModuleNew->module()->associate($moduleExistant);
            $assocSemestreModuleNew->save();
            $messagePane = 'Module a été créée';
            return $messagePane;
        }
    }


    public function updateModule(Request $request, $idModule)
    {
        $moduleExistant = Module::findOrFail($idModule);
        if ($moduleExistant) {
            if ($moduleExistant->nom_module == mb_strtoupper($request->get('nomModule'))) {
                $moduleExistant->nom_module = mb_strtoupper($request->get('nomModule'));
                $moduleExistant->libelle = mb_strtoupper($request->get('libelle'));
                $moduleExistant->save();
                return 1;
            } else {
                $allModulesInDB = Module::all();
                foreach ($allModulesInDB as $module) {
                    if ($module->nom_module == mb_strtoupper($request->get('nomModule'))) {
                        return -1;
                    }
                }

                $moduleExistant->nom_module = mb_strtoupper($request->get('nomModule'));
                $moduleExistant->libelle = mb_strtoupper($request->get('libelle'));
                $moduleExistant->save();
                return 1;


            }
        } else {
            return -2;
        }
    }


    public function deleteModule($idModule)
    {
        $moduleExistant = Module::findOrFail($idModule);
        if ($moduleExistant) {
            $assocsSemestreModule = semestreModule::get()->where('module_id', $idModule);
            $data = array();
            foreach ($assocsSemestreModule as $assocSemModule) {
                semestreModule::destroy($assocSemModule->id);
            }
            Module::destroy($moduleExistant->id);
            return 1;
        } else {
            return -2;
        }

    }

}
