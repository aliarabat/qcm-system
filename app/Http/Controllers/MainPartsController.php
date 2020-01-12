<?php

namespace App\Http\Controllers;

use App\AssocFiliereModule;
use App\Chapitre;
use App\Filiere;
use App\Module;
use App\Niveau;

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
    private $allAssocFilieresModules;
    private $chapitres;

    
    public function create()
    {
        $this->niveaux=Niveau::all();
        $this->filieres=Filiere::all();
        $this->modules=Module::all();
        $this->allAssocFilieresModules=AssocFiliereModule::all();
        $this->chapitres=Chapitre::all();
        return view(
            'mainparts.create',
            ['modules' => $this->modules, 'filieres' => $this->filieres, 'niveaux' => $this->niveaux,'assocfilmod' => $this->allAssocFilieresModules,'chapitres' => $this->chapitres]
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
            //$request->session()->flash('errorStatus', 'Ce Niveau est déja créé');
            $messagePane='Ce Niveau est déjà créé';
            return $messagePane;
        } else {
            $niveau = new Niveau();
            $niveau->niveau = mb_strtoupper($request->input('niveau'));
            $niveau->type = mb_strtoupper($request->input('type'));
            $niveau->save();
            $messagePane='Le Niveau a été créé';
            return $messagePane;
            //$request->session()->flash('status', 'Le Niveau a été créé');
            //return 1;
        }
    }

    public function updateNiveau(Request $request,$idNiveau)
    {
        $niveauExistant = Niveau::findOrFail($idNiveau);
        if ($niveauExistant) {
            $niveauExistant1 = Niveau::get()->where('niveau', mb_strtoupper($request->get('nomNiveau')))->where('type', mb_strtoupper($request->get('typeNiveau')))->first();
            if ($niveauExistant1) {
            //$messagePane='Ce Niveau est déjà existant';
            //return $messagePane;
            return -1;
            } else {
                $niveauExistant->niveau = mb_strtoupper($request->get('nomNiveau'));
                $niveauExistant->type = mb_strtoupper($request->get('typeNiveau'));
                $niveauExistant->save();
                //return json_encode($niveauExistant);
                //$messagePane='Le Niveau a été modifié';
                //return $messagePane;
                return 1;
            }     
        } 
        else {
            //$messagePane='Erreur inconnue';
            //return $messagePane; 
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
                $assocFiliereModule=AssocFiliereModule::get()->where('filiere_id', $filiere->id);
                foreach ($assocFiliereModule as $assocFilModule) {
                    $module=Module::get()->where('id', $assocFilModule->module_id)->first();
                    array_push($data, $module);
                    }
                }
            Niveau::destroy($idNiveau);
            foreach ($data as $itemModule) {
                    Module::destroy($itemModule->id);
            }
            //$messagePane='Le Niveau a été supprimé';
            //return $messagePane;
            return 1;
        } 
        else {
            //$messagePane='Erreur inconnue';
            //return $messagePane;
            return -1;       
          }
    }




    //Création d'une nouvelle filiere

    public function createFiliere(Request $request)
    {
        $testSelectNiveau = $request->input('niveauFiliere');
        if($testSelectNiveau == null){
            $messagePane='Veuillez choisir la filière';
            return $messagePane;
        }
        else{
            $filiereExistant = Filiere::get()->where('nom_filiere', mb_strtoupper($request->input('nom_filiere')))->first();
            if ($filiereExistant) {
                //$request->session()->flash('errorStatus', 'Cette filière est déja créée');
                //return -1;
                $messagePane='Cette filière est déja créée';
                return $messagePane;
    
            } else {
                $filiere = new Filiere();
                $filiere->nom_filiere = mb_strtoupper($request->input('nom_filiere'));
                $filiere->libelle = mb_strtoupper($request->input('libelle'));
                $selectNiveau = $request->input('niveauFiliere');
                //dd($selectNiveau);
                $infosNiveau = explode("-", $selectNiveau);
                //dd($infosNiveau[0].$infosNiveau[1]);
                $niveauExistant = Niveau::get()->where('niveau', mb_strtoupper($infosNiveau[0]))->where('type', mb_strtoupper($infosNiveau[1]))->first();
                $filiere->niveau()->associate($niveauExistant)->save();
                //$request->session()->flash('status', 'Filière a été créée');
                //return 1;
                $messagePane='Filière a été créée';
                return $messagePane;
            }
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
          $assocsFiliereModule=AssocFiliereModule::get()->where('filiere_id', $idFiliere);
          $data = array();
            foreach ($assocsFiliereModule as $assocFilModule) {
                
                    $module=Module::get()->where('id', $assocFilModule->module_id)->first();
                    $tmpAssocFilMol=AssocFiliereModule::get()->where('module_id', $module->id);
                    $lentmpAssocFilMol=count($tmpAssocFilMol);
                    if($lentmpAssocFilMol==1){
                        array_push($data, $module);
                    }
                }
            Filiere::destroy($idFiliere);
            foreach ($data as $itemModule) {
                    Module::destroy($itemModule->id);
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
            $assocFiliereModule = AssocFiliereModule::get()->where('filiere_id', $filiereExistant->id)->where('module_id', $moduleExistant->id)->first();
            if ($assocFiliereModule) {
                //$request->session()->flash('errorStatus', 'Ce module est déja associé à cette filière');
                //return -1;
                $messagePane='Ce module est déjà associé à cette filière';
                return $messagePane;
            } else {
                $assocFilieresModules = AssocFiliereModule::get()->where('module_id', $moduleExistant->id)->first();
                $filiereExistant1 = Filiere::get()->where('id', $assocFilieresModules->filiere_id)->first();
                if($filiereExistant1->niveau_id == $filiereExistant->niveau_id){
                $assocFiliereModuleNew = new AssocFiliereModule();
                $assocFiliereModuleNew->filiere()->associate($filiereExistant);
                $assocFiliereModuleNew->module()->associate($moduleExistant);
                $assocFiliereModuleNew->save();
                //$request->session()->flash('status', 'Ce module a été associé à cette filière');
                //return 1;
                $messagePane='Ce module a été associé à cette filière';
                return $messagePane;
                }
                else{
                    //$request->session()->flash('errorStatus', 'Ce module est déja associé à un certain niveau');
                    //return -2;
                $messagePane='Ce module est déjà associé à un certain niveau';
                return $messagePane;
                }
                
            }
        } else {
            $module = new Module();
            $module->nom_module = mb_strtoupper($request->input('nom_module'));
            $module->libelle = mb_strtoupper($request->input('libelleModule'));
            $module->save();
            $selectFiliere = $request->input('filiereModule');
            $infosFiliere = explode("-", $selectFiliere);
            $filiereExistant = Filiere::get()->where('nom_filiere', mb_strtoupper($infosFiliere[0]))->first();
            $assocFiliereModuleNew = new AssocFiliereModule();
            $assocFiliereModuleNew->filiere()->associate($filiereExistant);
            $assocFiliereModuleNew->module()->associate($module);
            $assocFiliereModuleNew->save();
            //$request->session()->flash('status', 'module a été créée');
            //return 2;
            $messagePane='Module a été créée';
            return $messagePane;
        }
    }


    public function updateModule(Request $request,$idModule)
    {
        $moduleExistant = Module::findOrFail($idModule);
        if ($moduleExistant) {
            if($moduleExistant->nom_module==mb_strtoupper($request->get('nomModule'))){
            $selectFiliere = $request->get('filiere');
            $filiereExistant = Filiere::get()->where('nom_filiere', mb_strtoupper($selectFiliere))->first();
            $assocFiliereModule = AssocFiliereModule::get()->where('filiere_id', $filiereExistant->id)->where('module_id', $moduleExistant->id)->first();
            $oldfiliere = Filiere::get()->where('nom_filiere', mb_strtoupper($request->get('oldFiliere')))->first();
            $previousAssocFiliereModule=AssocFiliereModule::get()->where('module_id', $moduleExistant->id)->where('filiere_id', $oldfiliere->id)->first();
            if ($assocFiliereModule->id == $previousAssocFiliereModule->id) {
                $moduleExistant->nom_module=mb_strtoupper($request->get('nomModule'));
                $moduleExistant->libelle=mb_strtoupper($request->get('libelle'));
                $moduleExistant->save();
                $previousAssocFiliereModule->filiere()->associate($filiereExistant);
                $previousAssocFiliereModule->module()->associate($moduleExistant)->save();
                return 3;
            }
            /*else if($assocFiliereModule->id != $previousAssocFiliereModule->id){
              return -4;
            } */
            else {
                $assocFilieresModules = AssocFiliereModule::get()->where('module_id', $moduleExistant->id)->first();
                $filiereExistant1 = Filiere::get()->where('id', $assocFilieresModules->filiere_id)->first();
                if($filiereExistant1->niveau_id == $filiereExistant->niveau_id){
                //$oldfiliere = Filiere::get()->where('nom_filiere', mb_strtoupper($request->get('oldFiliere')))->first();
                //$previousAssocFiliereModule=AssocFiliereModule::get()->where('module_id', $moduleExistant->id)->where('filiere_id', $oldfiliere->id)->first();
                $moduleExistant->nom_module=mb_strtoupper($request->get('nomModule'));
                $moduleExistant->libelle=mb_strtoupper($request->get('libelle'));
                $moduleExistant->save();
                $previousAssocFiliereModule->filiere()->associate($filiereExistant);
                $previousAssocFiliereModule->module()->associate($moduleExistant)->save();
                return 1;
                }
                else{
                    return -2;
                }
                
            }
        }

        else{
            $moduleExistant1 = Module::get()->where('nom_module', mb_strtoupper($request->get('nom_module')))->first();
            if ($moduleExistant1) {
                return -3;
            } else {
                $selectFiliere = $request->get('filiere');
                $filiereExistant = Filiere::get()->where('nom_filiere', mb_strtoupper($selectFiliere))->first();
                $assocFiliereModule = AssocFiliereModule::get()->where('filiere_id', $filiereExistant->id)->where('module_id', $moduleExistant->id)->first();
                $oldfiliere = Filiere::get()->where('nom_filiere', mb_strtoupper($request->get('oldFiliere')))->first();
                $previousAssocFiliereModule=AssocFiliereModule::get()->where('module_id', $moduleExistant->id)->where('filiere_id', $oldfiliere->id)->first();
            if ($assocFiliereModule->id == $previousAssocFiliereModule->id) {
                $moduleExistant->nom_module=mb_strtoupper($request->get('nomModule'));
                $moduleExistant->libelle=mb_strtoupper($request->get('libelle'));
                $moduleExistant->save();
                $previousAssocFiliereModule->filiere()->associate($filiereExistant);
                $previousAssocFiliereModule->module()->associate($moduleExistant)->save();
                return 4;
            }
            /*else if($assocFiliereModule->id != $previousAssocFiliereModule->id){
              return -4;
            } */
                else {
                    $assocFilieresModules = AssocFiliereModule::get()->where('module_id', $moduleExistant->id)->first();
                    $filiereExistant1 = Filiere::get()->where('id', $assocFilieresModules->filiere_id)->first();
                    if($filiereExistant1->niveau_id == $filiereExistant->niveau_id){
                    $previousAssocFiliereModule=AssocFiliereModule::get()->where('module_id', $moduleExistant->id)->where('filiere_id', $filiereExistant->id)->first();
                    $moduleExistant->nom_module=mb_strtoupper($request->get('nomModule'));
                    $moduleExistant->libelle=mb_strtoupper($request->get('libelle'));
                    $moduleExistant->save();
                    $previousAssocFiliereModule->filiere()->associate($filiereExistant);
                    $previousAssocFiliereModule->module()->associate($moduleExistant)->save();
                    return 1;
                    }
                    else{
                        return -5;
                    }
                    
                }
            }     
        }
        } else {
            return -6;
        }
    }



    public function deleteModule($idModule){
        $moduleExistant = Module::findOrFail($idModule);
        if ($moduleExistant) {
          $assocsFiliereModule=AssocFiliereModule::get()->where('module_id', $idModule);
          $data = array();
            foreach ($assocsFiliereModule as $assocFilModule) {
                    AssocFiliereModule::destroy($assocFilModule->id);
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
                    //$request->session()->flash('errorStatus', 'Ce Chapitre est déja associé à ce module');
                    //return -1;
                    $messagePane='Ce Chapitre est déjà associé à ce module';
                    return $messagePane;
                }
            }
            $chapitre->module()->associate($moduleExistant)->save();
            //$request->session()->flash('status', 'Ce Chapitre a été associé à ce module');
            //return 1;
            $messagePane='Ce Chapitre a été associé au module';
            return $messagePane;
        } else {
            $chapitre->module()->associate($moduleExistant)->save();
            //$request->session()->flash('status', 'Le nouveau chapitre a été associé à ce module');
            //return 2;
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
        $assocFiliereModule = AssocFiliereModule::get()->where('filiere_id', $filiereExistant->id);
        $data = array();
        foreach ($assocFiliereModule as $filmol) {
            $moduleExistant = Module::get()->where('id', $filmol->module_id)->first();
            array_push($data, $moduleExistant);
        }
        $modulesData['data'] = $data;
        return json_encode($modulesData);
    }
}
