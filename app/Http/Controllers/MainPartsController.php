<?php

namespace App\Http\Controllers;

use App\Chapitre;
use App\Filiere;
use App\Module;
use App\Niveau;
use App\Semestre;
use App\semestreModule;

use Illuminate\Http\Request;

class MainPartsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Niveau::class, 'create');

    }
    private $niveaux;
    private $filieres;
    private $modules;
    private $allAssocSemestreModules;
    private $chapitres;


    
    public function create()
    {
        $this->niveaux=Niveau::all();
        $this->filieres=Filiere::all();
        $this->modules=Module::all();
        $this->allAssocSemestreModules=semestreModule::all();
        $this->chapitres=Chapitre::all();
        return view(
            'mainparts.create',
            ['modules' => $this->modules, 'filieres' => $this->filieres, 'niveaux' => $this->niveaux,'assocSemestreModule' => $this->allAssocSemestreModules,'chapitres' => $this->chapitres]
        );
    }

    public function refreshNiveaux(){
        $allNiveaux=Niveau::all();
        $data = array();
        foreach ($allNiveaux as $niveau) {
            array_push($data, $niveau);
        }
        $niveauxData['data'] = $data;
        return json_encode($niveauxData);
    }

    public function refreshFilieres(){
        $allFilieres=Filiere::all();
        $data = array();
        foreach ($allFilieres as $filiere) {
            array_push($data, $filiere);
        }
        $filieresData['data'] = $data;
        return json_encode($filieresData);
    }



    //Création d'un nouveau niveau

    public function createNiveau(Request $request)
    {
        $niveauExistant = Niveau::get()->where('niveau', mb_strtoupper($request->input('niveau')))->where('type', mb_strtoupper($request->input('type')))->first();
        if ($niveauExistant) {
            $messagePane='Ce Niveau est déjà créé';
            return $messagePane;
        } else {
            $niveau = new Niveau();
            $niveau->niveau = mb_strtoupper($request->input('niveau'));
            $niveau->type = mb_strtoupper($request->input('type'));
            $niveau->save();
            $messagePane='Le Niveau a été créé';
            return $messagePane;
            
        }
    }

    public function updateNiveau(Request $request,$idNiveau)
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
        } 
        else {
            return -2;       
        }
    }

    public function deleteNiveau($idNiveau)
    {
        $niveauExistant = Niveau::findOrFail($idNiveau);
        if ($niveauExistant) {
          $filieresById=Filiere::get()->where('niveau_id', $idNiveau);
          $data = array();
            foreach ($filieresById as $filiere) {
                $semestresFiliere=Semestre::get()->where('filiere_id', $filiere->id);
                foreach ($semestresFiliere as $semestre) {
                    $array_semestre_module = semestreModule::get()->where('semestre_id', $semestre->id);
                    foreach($array_semestre_module as $semestre_module){
                        $moduleExistant=Module::get()->where('id', $semestre_module->module_id)->first();
                        array_push($data,$moduleExistant );
                    }
                }
                }
            Niveau::destroy($idNiveau);
            foreach ($data as $itemModule) {
                $newArray_semestre_module = semestreModule::get()->where('module_id', $itemModule->id);
                if($newArray_semestre_module){
                    continue;
                }
                else{
                    Module::destroy($itemModule->id);
                }
            }
            return 1;
        } 
        else {
            return -1;       
          }
    }




    //Création d'une nouvelle filiere

    public function createFiliere(Request $request)
    {
        /*$testSelectNiveau = $request->input('niveauFiliere');
        if($testSelectNiveau == null){
            $messagePane='Veuillez choisir la filière';
            return $messagePane;
        }
        else{*/
            $filiereExistant = Filiere::get()->where('nom_filiere', mb_strtoupper($request->input('nom_filiere')))->first();
            if ($filiereExistant) {
                $messagePane='Cette filière est déja créée';
                return $messagePane;
    
            } else {
                $filiere = new Filiere();
                $filiere->nom_filiere = mb_strtoupper($request->input('nom_filiere'));
                $filiere->libelle = mb_strtoupper($request->input('libelle'));
                $selectNiveau = $request->input('niveauFiliere');
                $semestres=intval($request->input('semestres'));
                $infosNiveau = explode("-", $selectNiveau);
                $niveauExistant = Niveau::get()->where('niveau', mb_strtoupper($infosNiveau[0]))->where('type', mb_strtoupper($infosNiveau[1]))->first();
                $filiere->niveau()->associate($niveauExistant)->save();
                $filiereApresSave = Filiere::get()->where('nom_filiere', mb_strtoupper($request->input('nom_filiere')))->first();
                $lastid = $filiereApresSave->id;
                for($i=1;$i<=$semestres;$i++) {

                    $semestresFiliere = array(

                        'filiere_id' => $lastid,
                        'libelle' => 'S'.$i
                    );
                    Semestre::insert($semestresFiliere);
                }
                $messagePane='Filière avec ses semestres ont été créés';
                return $messagePane;
            }
    }
    public function updateFiliere(Request $request,$idFiliere)
    {
        $filiereExistant = Filiere::findOrFail($idFiliere);
        if ($filiereExistant) {
            if($filiereExistant->nom_filiere==mb_strtoupper($request->get('nomFiliere'))){
                $selectNiveau = $request->get('niveau');
                $infosNiveau = explode("-", $selectNiveau);
                $niveauExistant = Niveau::get()->where('niveau', mb_strtoupper($infosNiveau[0]))->where('type', mb_strtoupper($infosNiveau[1]))->first();
                $filiereExistant->nom_filiere = mb_strtoupper($request->get('nomFiliere'));
                $filiereExistant->libelle = mb_strtoupper($request->get('libelle'));
                $filiereExistant->niveau()->associate($niveauExistant)->save();
                return 1;
            }
            $filiereExistant1 =Filiere::get()->where('nom_filiere', mb_strtoupper($request->get('nomFiliere')))->first();
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
        } 
        else {
            return -2;
        }


    }


    public function deleteFiliere($idFiliere){
        $filiereExistante = Filiere::findOrFail($idFiliere);
        if ($filiereExistante) {
            $data = array();
            $semestresFiliere=Semestre::get()->where('filiere_id', $filiereExistante->id);
            foreach ($semestresFiliere as $semestre) {
                $array_semestre_module = semestreModule::get()->where('semestre_id', $semestre->id);
                foreach($array_semestre_module as $semestre_module){
                    $moduleExistant=Module::get()->where('id', $semestre_module->module_id)->first();
                    array_push($data,$moduleExistant );
                }
            }
            Filiere::destroy($idFiliere);
            foreach ($data as $itemModule) {
                $newArray_semestre_module = semestreModule::get()->where('module_id', $itemModule->id);
                if($newArray_semestre_module){
                    continue;
                }
                else{
                    Module::destroy($itemModule->id);
                }
            }
            return 1;
        } 
        else {
            return -2;
        }

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
                $messagePane='Ce module est déjà associé à cette filière pour un semestre';
                return $messagePane;
            } else {
                //$semestreId = $semestreExistant->id;
                //$moduleId=$moduleExistant->id;
                $assocSemestreModuleNew = new semestreModule();
                $assocSemestreModuleNew->semestre()->associate($semestreExistant);
                $assocSemestreModuleNew->module()->associate($moduleExistant);
                $assocSemestreModuleNew->save();
                $messagePane='Ce module a été associé à cette filière';
                return $messagePane;
                    
                
            }
        }else { 
            $module = new Module();
            $module->nom_module = mb_strtoupper($request->input('nom_module'));
            $module->libelle = mb_strtoupper($request->input('libelleModule'));
            $module->save();
            $selectFiliere = $request->input('filiereModule');
            $infosFiliere = explode("-", $selectFiliere);
            $filiereExistant = Filiere::get()->where('nom_filiere', mb_strtoupper($infosFiliere[0]))->first();
            //$filiereExistant = Filiere::get()->where('id',intval($selectFiliere) )->first();
            $selectedSemestre = $request->input('semestreFiliere');
            $semestreExistant = Semestre::get()->where('libelle',  $selectedSemestre)->where('filiere_id', $filiereExistant->id)->first();
            $moduleExistant = Module::get()->where('nom_module', mb_strtoupper($request->input('nom_module')))->first();
            //$semestreId = $semestreExistant->id;
            //$moduleId=$moduleExistant->id;
            $assocSemestreModuleNew = new semestreModule();
            $assocSemestreModuleNew->semestre()->associate($semestreExistant);
            $assocSemestreModuleNew->module()->associate($moduleExistant);
            $assocSemestreModuleNew->save();
            $messagePane='Module a été créée';
            return $messagePane;
        }
    }


    public function updateModule(Request $request,$idModule)
    {
        $moduleExistant = Module::findOrFail($idModule);
        if ($moduleExistant) {
            if($moduleExistant->nom_module==mb_strtoupper($request->get('nomModule'))){
                $moduleExistant->nom_module=mb_strtoupper($request->get('nomModule'));
                $moduleExistant->libelle=mb_strtoupper($request->get('libelle'));
                $moduleExistant->save();
                return 1;
            }
            
            else {
            $allModulesInDB = Module::all();
            foreach($allModulesInDB as $module){
            if($module->nom_module==mb_strtoupper($request->get('nomModule'))){
            return -1;
                }
            }
               
                $moduleExistant->nom_module=mb_strtoupper($request->get('nomModule'));
                $moduleExistant->libelle=mb_strtoupper($request->get('libelle'));
                $moduleExistant->save();
                return 1;
                
            
            }
        } else {
            return -2;
        }
    }



    public function deleteModule($idModule){
        $moduleExistant = Module::findOrFail($idModule);
        if ($moduleExistant) {
          $assocsSemestreModule=semestreModule::get()->where('module_id', $idModule);
          $data = array();
            foreach ($assocsSemestreModule as $assocSemModule) {
                semestreModule::destroy($assocSemModule->id);
                }
                    Module::destroy($moduleExistant->id);
            return 1;
        } 
        else {
            return -2;
        }

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
                    $messagePane='Ce Chapitre est déjà associé à ce module';
                    return $messagePane;
                }
            }
            $chapitre->module()->associate($moduleExistant)->save();
            $messagePane='Ce Chapitre a été associé au module';
            return $messagePane;
        } else {
            $chapitre->module()->associate($moduleExistant)->save();
            $messagePane='Le nouveau chapitre a été associé au module';
            return $messagePane;
        }
    }


    public function updateChapitre(Request $request,$idChapitre){
        $chapitreExistant = Chapitre::findOrFail($idChapitre);
        if ($chapitreExistant) {
            if($chapitreExistant->nom_chapitre==mb_strtoupper($request->get('chapitre'))){
                $chapitreExistant->nom_chapitre= mb_strtoupper($request->get('chapitre'));
                $chapitreExistant->save();
                return 1;
            }
            else{
            $chapitreExistant1 =Chapitre::get()->where('nom_module', mb_strtoupper($request->get('chapitre')))->first();
            if ($chapitreExistant1) {
                return -1;
            } else {
                $chapitreExistant->nom_chapitre= mb_strtoupper($request->get('chapitre'));
                $chapitreExistant->save();
                return 2;
            }
        }     
        } 
        else {
            return -2;
        }
    }


    public function deleteChapitre($idChapitre){
        $chapitreExistant = Chapitre::findOrFail($idChapitre);
        if ($chapitreExistant) {
            Chapitre::destroy($idChapitre);
            return 1;
        } 
        else {
            return -2;
        }
    }



    //Génération du select module par la filiere

    public function modulesFiliere(Request $request)
    {
        $this->validate($request, ['nom_filiere' => 'required|exists:filieres,nom_filiere']);
        $filiereExistant = Filiere::get()->where('nom_filiere', mb_strtoupper($request->get('nom_filiere')))->first();
        $semestresFiliere=Semestre::get()->where('filiere_id', $filiereExistant->id);
        $data = array();
        foreach ($semestresFiliere as $semestre) {
            $array_semestre_module = semestreModule::get()->where('semestre_id', $semestre->id);
            foreach($array_semestre_module as $semestre_module){
                $moduleExistant=Module::get()->where('id', $semestre_module->module_id)->first();
                array_push($data,$moduleExistant );
            }
        }
        $modulesData['data'] = $data;
        return json_encode($modulesData);
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
}
