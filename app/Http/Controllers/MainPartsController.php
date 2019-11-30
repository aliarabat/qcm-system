<?php

namespace App\Http\Controllers;

use App\Filiere;
use App\Niveau;
use Illuminate\Http\Request;

class MainPartsController extends Controller
{
    public function create()
    {
        $niveaux=Niveau::all();
        return view('mainparts.create',['niveaux'=>$niveaux]);
    }

    public function createNiveau(Request $request)
    {
        $niveauExistant =Niveau::get()->where('niveau',mb_strtoupper($request->input('niveau')))->where('type',mb_strtoupper($request->input('type')))->first();
        if($niveauExistant){
            return redirect()->route('mainParts.create');
        }
        else{
            $niveau=new Niveau();
            $niveau->niveau=mb_strtoupper($request->input('niveau'));
            $niveau->type=mb_strtoupper($request->input('type'));
            $niveau->save();
            return redirect()->route('mainParts.create');
    }
    }


    public function createFiliere(Request $request)
    {
           $filiereExistant=Filiere::get()->where('nom_filiere',mb_strtoupper($request->input('nom_filiere')))->first();
           if($filiereExistant){
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
            //$filiere->save();
            return redirect()->route('mainParts.create');
            
    }
    }

    
}
