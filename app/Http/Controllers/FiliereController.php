<?php

namespace App\Http\Controllers;

use App\Filiere;
use App\Module;
use App\Niveau;
use App\Semestre;
use App\semestreModule;
use Illuminate\Http\Request;

class FiliereController extends Controller
{
    //
    private $niveaux;
    private $filieres;


    public function showFiliere()
    {
        $this->niveaux = Niveau::all();
        $this->filieres = Filiere::all();
        return view(
            'mainparts.filiere',
            ['filieres' => $this->filieres, 'niveaux' => $this->niveaux]
        );
    }

    //Création d'une nouvelle filiere

    public function createFiliere(Request $request)
    {
        $filiereExistant = Filiere::get()->where('nom_filiere', mb_strtoupper($request->input('nom_filiere')))->first();
        if ($filiereExistant) {
            $messagePane = 'Cette filière est déja créée';
            return $messagePane;

        } else {
            $filiere = new Filiere();
            $filiere->nom_filiere = mb_strtoupper($request->input('nom_filiere'));
            $filiere->libelle = mb_strtoupper($request->input('libelle'));
            $selectNiveau = $request->input('niveauFiliere');
            $semestres = intval($request->input('semestres'));
            $infosNiveau = explode("-", $selectNiveau);
            $niveauExistant = Niveau::get()->where('niveau', mb_strtoupper($infosNiveau[0]))->where('type', mb_strtoupper($infosNiveau[1]))->first();
            $filiere->niveau()->associate($niveauExistant)->save();
            $filiereApresSave = Filiere::get()->where('nom_filiere', mb_strtoupper($request->input('nom_filiere')))->first();
            $lastid = $filiereApresSave->id;
            for ($i = 1; $i <= $semestres; $i++) {

                $semestresFiliere = array(

                    'filiere_id' => $lastid,
                    'libelle' => 'S' . $i
                );
                Semestre::insert($semestresFiliere);
            }
            $messagePane = 'Filière avec ses semestres ont été créés';
            return $messagePane;
        }
    }

    public function updateFiliere(Request $request, $idFiliere)
    {
        $filiereExistant = Filiere::findOrFail($idFiliere);
        if ($filiereExistant) {
            if ($filiereExistant->nom_filiere == mb_strtoupper($request->get('nomFiliere'))) {
                $selectNiveau = $request->get('niveau');
                $infosNiveau = explode("-", $selectNiveau);
                $niveauExistant = Niveau::get()->where('niveau', mb_strtoupper($infosNiveau[0]))->where('type', mb_strtoupper($infosNiveau[1]))->first();
                //$niveauExistant = Niveau::find(intval($selectNiveau));
                $filiereExistant->nom_filiere = mb_strtoupper($request->get('nomFiliere'));
                $filiereExistant->libelle = mb_strtoupper($request->get('libelle'));
                $filiereExistant->niveau()->associate($niveauExistant)->save();
                return 1;
            }
            $filiereExistant1 = Filiere::get()->where('nom_filiere', mb_strtoupper($request->get('nomFiliere')))->first();
            if ($filiereExistant1) {
                return -1;
            } else {
                $selectNiveau = $request->get('niveau');
                $infosNiveau = explode("-", $selectNiveau);
                $niveauExistant = Niveau::get()->where('niveau', mb_strtoupper($infosNiveau[0]))->where('type', mb_strtoupper($infosNiveau[1]))->first();
                $filiereExistant->nom_filiere = mb_strtoupper($request->get('nomFiliere'));
                $filiereExistant->libelle = mb_strtoupper($request->get('libelle'));
                $filiereExistant->niveau()->associate($niveauExistant)->save();
                return 2;
            }
        } else {
            return -2;
        }


    }


    public function deleteFiliere($idFiliere)
    {
        $filiereExistante = Filiere::findOrFail($idFiliere);
        if ($filiereExistante) {
            $data = array();
            $semestresFiliere = Semestre::get()->where('filiere_id', $filiereExistante->id);
            foreach ($semestresFiliere as $semestre) {
                $array_semestre_module = semestreModule::get()->where('semestre_id', $semestre->id);
                foreach ($array_semestre_module as $semestre_module) {
                    $moduleExistant = Module::get()->where('id', $semestre_module->module_id)->first();
                    array_push($data, $moduleExistant);
                }
            }
            Filiere::destroy($idFiliere);
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
            return -2;
        }

    }

}
