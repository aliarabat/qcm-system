<?php

namespace App\Http\Controllers;

use App\Niveau;
use Illuminate\Http\Request;

class MainPartsController extends Controller
{
    public function create()
    {
        return view('mainparts.create');
    }

    public function createNiveau(Request $request)
    {
        $niveau=new Niveau();
        $niveau->niveau=$request->input('niveau');
        $niveau->type=$request->input('type');
        $niveau->save();
        return redirect()->route('mainParts.create');


    }

    
}
