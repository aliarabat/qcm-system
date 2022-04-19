<?php

namespace App\Http\Controllers;

use App\Niveau;
use Illuminate\Http\Request;

class CreateNiveauController extends Controller
{
    //
    public function showCreateNiveau()
    {
        return view(
            'mainparts.niveau.createNiveau'
        );
    }

    //Création d'un nouveau niveau

    public function create(Request $request)
    {
        $niveauExistant = Niveau::get()->where('niveau', mb_strtoupper($request->input('niveau')))->where('type', mb_strtoupper($request->input('type')))->first();
        if ($niveauExistant) {
            //$messagePane = 'Ce Niveau est déjà créé';
            //return $messagePane;
            $request->session()->flash('status','Ce Niveau est déjà créé');
            return redirect()->route('mainParts.niveau.createNiveau');

        } else {
            $niveau = new Niveau();
            $niveau->niveau = mb_strtoupper($request->input('niveau'));
            $niveau->type = mb_strtoupper($request->input('type'));
            $niveau->save();
            //$messagePane = 'Le Niveau a été créé';
            //return $messagePane;
            $request->session()->flash('status','Le Niveau a été créé');
            return redirect()->route('mainParts.niveau.niveaux');


        }
    }
}
