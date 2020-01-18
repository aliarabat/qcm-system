<?php

namespace App\Http\Controllers;


use App\Niveau;


use Illuminate\Http\Request;

class MainPartsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Niveau::class, 'create');

    }


    public function create()
    {

        return view(
            'mainparts.create'
        );
    }


}
