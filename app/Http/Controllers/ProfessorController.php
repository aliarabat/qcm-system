<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    public function index()
    {
        return view('professors.index');
    }
    
    public function create(Request $request)
    {
        $token=$request->input('_token');

        return response()->json(compact('token'));
    }
}
