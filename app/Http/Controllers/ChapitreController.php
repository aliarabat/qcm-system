<?php

namespace App\Http\Controllers;

use App\Chapitre;
use App\Filiere;
use App\Module;
use App\Semestre;
use App\semestreModule;
use Illuminate\Http\Request;

class ChapitreController extends Controller
{
    //
    private $filieres;
    private $chapitres;


    public function showChapitre()
    {
        $this->filieres = Filiere::all();
        $this->chapitres = Chapitre::all();
        return view(
            'mainparts.chapitre',
            ['filieres' => $this->filieres, 'chapitres' => $this->chapitres]
        );
    }

    //Génération du select module par la filiere

    public function modulesFiliere(Request $request)
    {
        $this->validate($request, ['nom_filiere' => 'required|exists:filieres,nom_filiere']);
        $filiereExistant = Filiere::get()->where('nom_filiere', mb_strtoupper($request->get('nom_filiere')))->first();
        $semestresFiliere = Semestre::get()->where('filiere_id', $filiereExistant->id);
        $data = array();
        foreach ($semestresFiliere as $semestre) {
            $array_semestre_module = semestreModule::get()->where('semestre_id', $semestre->id);
            foreach ($array_semestre_module as $semestre_module) {
                $moduleExistant = Module::get()->where('id', $semestre_module->module_id)->first();
                array_push($data, $moduleExistant);
            }
        }
        $modulesData['data'] = $data;
        return json_encode($modulesData);
    }

    //Création d'un nouveau chapitre

    public function createChapitre(Request $request)
    {
        $chapitre = new Chapitre();
        $chapitre->nom_chapitre = mb_strtoupper($request->input('nom_chapitre'));
        $selectModule = $request->input('moduleChapitre');
        $moduleExistant = Module::get()->where('nom_module', mb_strtoupper($selectModule))->first();
        $chapitresExistant = Chapitre::get()->where('module_id', $moduleExistant->id);
        if ($chapitresExistant) {
            foreach ($chapitresExistant as $chapitreItem) {
                if ($chapitreItem->nom_chapitre == $chapitre->nom_chapitre) {
                    $messagePane = 'Ce Chapitre est déjà associé à ce module';
                    return $messagePane;
                }
            }
            $chapitre->module()->associate($moduleExistant)->save();
            $messagePane = 'Ce Chapitre a été associé au module';
            return $messagePane;
        } else {
            $chapitre->module()->associate($moduleExistant)->save();
            $messagePane = 'Le nouveau chapitre a été associé au module';
            return $messagePane;
        }
    }


    public function updateChapitre(Request $request, $idChapitre)
    {
        $chapitreExistant = Chapitre::findOrFail($idChapitre);
        if ($chapitreExistant) {
            if ($chapitreExistant->nom_chapitre == mb_strtoupper($request->get('chapitre'))) {
                $chapitreExistant->nom_chapitre = mb_strtoupper($request->get('chapitre'));
                $chapitreExistant->save();
                return 1;
            } else {
                $chapitreExistant1 = Chapitre::get()->where('nom_module', mb_strtoupper($request->get('chapitre')))->first();
                if ($chapitreExistant1) {
                    return -1;
                } else {
                    $chapitreExistant->nom_chapitre = mb_strtoupper($request->get('chapitre'));
                    $chapitreExistant->save();
                    return 2;
                }
            }
        } else {
            return -2;
        }
    }


    public function deleteChapitre($idChapitre)
    {
        $chapitreExistant = Chapitre::findOrFail($idChapitre);
        if ($chapitreExistant) {
            Chapitre::destroy($idChapitre);
            return 1;
        } else {
            return -2;
        }
    }

}
