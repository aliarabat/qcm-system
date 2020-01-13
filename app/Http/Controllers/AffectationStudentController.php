<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AffectationStudentController extends Controller
{
    public function index()
    {
        return view('affectations.students.index');
    }

    public function store(Request $request)
    {
        return response()->json('Hello');
    }
}
