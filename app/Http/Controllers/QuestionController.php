<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Http\Controllers\Controller;

use App\Question;
use App\Proposition;

class QuestionController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('questions.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        
        $question = new Question();
        $question->chapitre = request('chapitre');
        $question->question = request('question');
        $question->duree = request('duree');
        $question->difficulte = request('difficulte');
        $question->visibilite = request('visibilite');
        $question->note = request('note');
        $counts = array_count_values($request->reponse);
            if($counts[1]>1){
                $question->type = 'multi';
            }
        $question->save();
        $lastid=$question->id;
        if(count($request->proposition)>0)
        { 
            foreach($request->proposition as $propositon=>$p){
                
            $propositions=array(
                
                'question_id'=>$lastid,
                'proposition'=>$request->proposition[$propositon],
                'reponse'=>$request->reponse[$propositon]
            );
            Proposition::insert($propositions);
        }
        
        dd($counts[1]);
    }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    
}
