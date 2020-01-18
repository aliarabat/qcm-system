<?php

namespace App\Http\Controllers;

use App\Filiere;
use App\Module;
use App\Niveau;
use App\Semestre;
use App\semestreModule;
use Illuminate\Http\Request;

class NiveauController extends Controller
{
    //
    private $niveaux;

    public function showNiveaux()
    {
        $this->niveaux = Niveau::all();
        return view(
            'mainparts.niveau.niveaux',
            ['niveaux' => $this->niveaux,]
        );
    }


    public function updateNiveau(Request $request, $idNiveau)
    {
        $niveauExistant = Niveau::findOrFail($idNiveau);
        if ($niveauExistant) {
            $niveauExistant1 = Niveau::get()->where('niveau', mb_strtoupper($request->get('nomNiveau')))->where('type', mb_strtoupper($request->get('typeNiveau')))->first();
            if ($niveauExistant1) {
                return -1;
            } else {
                $niveauExistant->niveau = mb_strtoupper($request->get('nomNiveau'));
                $niveauExistant->type = mb_strtoupper($request->get('typeNiveau'));
                $niveauExistant->save();
                return 1;
            }
        } else {
            return -2;
        }
    }

    public function deleteNiveau($idNiveau)
    {
        $niveauExistant = Niveau::findOrFail($idNiveau);
        if ($niveauExistant) {
            $filieresById = Filiere::get()->where('niveau_id', $idNiveau);
            $data = array();
            foreach ($filieresById as $filiere) {
                $semestresFiliere = Semestre::get()->where('filiere_id', $filiere->id);
                foreach ($semestresFiliere as $semestre) {
                    $array_semestre_module = semestreModule::get()->where('semestre_id', $semestre->id);
                    foreach ($array_semestre_module as $semestre_module) {
                        $moduleExistant = Module::get()->where('id', $semestre_module->module_id)->first();
                        array_push($data, $moduleExistant);
                    }
                }
            }
            Niveau::destroy($idNiveau);
            foreach ($data as $itemModule) {
                $newArray_semestre_module = semestreModule::get()->where('module_id', $itemModule->id);
                if ($newArray_semestre_module) {
                    continue;
                } else {
                    Module::destroy($itemModule->id);
                }
            }
            return 1;
        } else {
            return -1;
        }
    }
}
