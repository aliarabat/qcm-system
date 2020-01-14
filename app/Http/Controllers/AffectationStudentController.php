<?php

namespace App\Http\Controllers;

use App\Niveau;
use Illuminate\Http\Request;

class AffectationStudentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        
        
    }
    public function index()
    {
        $this->authorize('create',Niveau::class);
        return view('affectations.students.index');
    }

    public function store(Request $request)
    {
        $this->authorize('create',Niveau::class);
        return response()->json('Hello');
    }
}
