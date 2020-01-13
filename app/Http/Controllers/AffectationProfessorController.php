<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AffectationProfessorController extends Controller
{
    public function index()
    {
        return view('affectations.professors.index');
    }

    public function store(Request $request)
    {
        return response()->json('Hello');
    }
}
