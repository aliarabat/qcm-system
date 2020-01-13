<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Proposition;
use App\Filiere;
use App\Module;
use App\Chapitre;
use App\QCM;
use App\AssocFiliereModule;

class QcmController extends Controller
{

    public function index()
    {
        $modules = Module::all();
        return view(
            'qcm.index',
            ['modules' => $modules]
        );
        
    }
    
    public function create(Request $request)
    {
        $token=$request->input('_token');

        return response()->json(compact('token'));
    }


    public function findChapitreByModule(Request $request)
    {
        $this->validate($request, ['nom_module' => 'required|exists:modules,nom_module']);
        $modules = Module::get()->where('nom_module', mb_strtoupper($request->get('nom_module')))->first();
        $data = array();
        $chapitres = [];
            $chapitres = Chapitre::get()->where('module_id', $modules->id);
            
           foreach( $chapitres as $chap){
            array_push($data, $chap);
    }
        $chapitresData['data'] = $data;
        
        return json_encode($chapitresData);
    }

    public function createQcm(Request $request)
    {     
        
        //$this->validate($request, ['nom_chapitre' => 'required|exists:chapitres,nom_chapitre']);
        //$this->validate($request, ['difficulte' => 'required|difficulte']);
        $chapitres = Chapitre::get()->where('nom_chapitre', mb_strtoupper($request->get('nom_chapitre')))->first();
        $data = array();
        $questions = array();
        $questionsFN = array();
       
        
            $questions = Question::get()->shuffle()->where('chapitre_id', $chapitres->id); 
            foreach($questions as $question){
                if($question->difficulte == "Difficile"){
               
                    array_push($data,$question); 
                        
               }else{

                array_push( $questionsFN,$question);  
               } 
    }
        $diff = $request->input('difficulte');
        $nbr = $request->get('nbrQuestionCahpitre');
        $nbrQstDiff = (int)(($nbr*$diff) / 100);
        $nbrQstFaNo = $nbr - $nbrQstDiff ;
        
        $questionsData['data'] =array_merge(array_slice($questionsFN, 1,   $nbrQstFaNo), array_slice($data, 1, $nbrQstDiff));

        return json_encode($questionsData);    
    }
    
}
