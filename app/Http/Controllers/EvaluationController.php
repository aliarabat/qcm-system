<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('evaluations.start');
    }

    public function create()
    {
        return view('evaluations.create');
    }

    public function start()
    {
        $qcm=[];
        $qcm['questions']=Question::all()->shuffle();
     
        foreach ($qcm['questions'] as $key => $question) {
            $question->propositions=$question->propositions->shuffle();
        }
        $qcm['wholeTime']=30;
        return view('evaluations.evaluate', compact(['qcm']));
    }

    public function end(Request $request)
    {
        $data=$request->input('data');
        return response()->json(compact('data'));   
    }


}
