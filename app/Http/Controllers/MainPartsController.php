<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainPartsController extends Controller
{
    public function create()
    {
        return view('mainparts.create');
    }
}
