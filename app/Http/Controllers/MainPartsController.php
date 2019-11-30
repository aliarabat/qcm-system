<?php

namespace App\Http\Controllers;

use App\AssocFiliereModule;
use App\Filiere;
use App\Module;
use App\Niveau;

use Illuminate\Http\Request;

class MainPartsController extends Controller
{
    public function create()
    {
        $niveaux=Niveau::all();
        $filieres=Filiere::all();
        $modules=Module::all();
        return view('mainparts.create',
        ['niveaux'=>$niveaux],
        ['filieres'=>$filieres],
        ['allModules'=>$modules]
    );
    }

    public function createNiveau(Request $request)
    {
        $niveauExistant =Niveau::get()->where('niveau',mb_strtoupper($request->input('niveau')))->where('type',mb_strtoupper($request->input('type')))->first();
        if($niveauExistant){
            $request->session()->flash('errorStatus','Ce Niveau est déja créé');
            return redirect()->route('mainParts.create');
        }
        else{
            $niveau=new Niveau();
            $niveau->niveau=mb_strtoupper($request->input('niveau'));
            $niveau->type=mb_strtoupper($request->input('type'));
            $niveau->save();
            $request->session()->flash('status','Le Niveau a été créé');
            return redirect()->route('mainParts.create');
    }
    }


    public function createFiliere(Request $request)
    {
           $filiereExistant=Filiere::get()->where('nom_filiere',mb_strtoupper($request->input('nom_filiere')))->first();
           if($filiereExistant){
            $request->session()->flash('errorStatus','Cette filière est déja créée');
            return redirect()->route('mainParts.create');
        }      
        else{
            $filiere=new Filiere();
            $filiere->nom_filiere=mb_strtoupper($request->input('nom_filiere'));
            $filiere->libelle=mb_strtoupper($request->input('libelle'));
            $selectNiveau = $request->input('niveauFiliere');
            //dd($selectNiveau);
            $infosNiveau=explode("-", $selectNiveau);
            //dd($infosNiveau[0].$infosNiveau[1]);
            $niveauExistant =Niveau::get()->where('niveau',mb_strtoupper($infosNiveau[0]))->where('type',mb_strtoupper($infosNiveau[1]))->first();
            $filiere->niveau()->associate($niveauExistant)->save();
            $request->session()->flash('status','Filière a été créée');
            return redirect()->route('mainParts.create');
            
    }
    }


    public function createModule(Request $request)
    {
        $moduleExistant=Module::get()->where('nom_module',mb_strtoupper($request->input('nom_module')))->first();
        if($moduleExistant){
         $selectFiliere = $request->input('filiereModule');
         $infosFiliere=explode("-", $selectFiliere);
         $filiereExistant =Filiere::get()->where('nom_filiere',mb_strtoupper($infosFiliere[0]))->first();
         $assocFiliereModule=AssocFiliereModule::get()->where('filiere_id',$filiereExistant->id)->where('module_id',$moduleExistant->id)->first();
         if($assocFiliereModule){
         $request->session()->flash('errorStatus','Ce module est déja associé à cette filière');
         return redirect()->route('mainParts.create');
        } 
        else{
            $assocFiliereModuleNew=new AssocFiliereModule();
            $assocFiliereModuleNew->filiere()->associate($filiereExistant);
            $assocFiliereModuleNew->module()->associate($moduleExistant);
            $assocFiliereModuleNew->save();
            $request->session()->flash('status','Ce module a été associé à cette filière');
            return redirect()->route('mainParts.create');
        } 
     }      
     else{
        $module=new Module();
        $module->nom_module=mb_strtoupper($request->input('nom_module'));
        $module->libelle=mb_strtoupper($request->input('libelle'));
        $module->save();
        $selectFiliere = $request->input('filiereModule');
         $infosFiliere=explode("-", $selectFiliere);
         $filiereExistant =Filiere::get()->where('nom_filiere',mb_strtoupper($infosFiliere[0]))->first();
         $assocFiliereModuleNew=new AssocFiliereModule();
            $assocFiliereModuleNew->filiere()->associate($filiereExistant);
            $assocFiliereModuleNew->module()->associate($module);
            $assocFiliereModuleNew->save();

         $request->session()->flash('status','module a été créée');
         return redirect()->route('mainParts.create');
         
 }
     
    }

    public function createChapitre(Request $request)
    {
        //  
    }

    
}
