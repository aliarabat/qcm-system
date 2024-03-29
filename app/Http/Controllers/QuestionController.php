<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Http\Controllers\Controller;

use App\Question;
use App\QuestionProfessor;
use App\User;
use App\Proposition;
use App\Filiere;
use App\Module;
use App\Chapitre;
use App\Semestre;
use App\SemestreModule;
use App\SemestreModuleProf;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('auth');
        
    }

    public function index()
    {
        $this->authorize('create',Question::class);
        return view('questions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    { 
         $filieress=[];
        $semestre_module_profs = SemestreModuleProf::where('professor_id',Auth::user()->id)->get();
        foreach($semestre_module_profs as $semestre_module_prof ){
            $semestre_modules = SemestreModule::where('id',$semestre_module_prof->semestre_module_id)->get();

            foreach($semestre_modules as $semestre_module ){
            $semestres = Semestre::where('id',$semestre_module->semestre_id)->get();

                foreach($semestres as $semestre){
                 $filieres = Filiere::where('id',$semestre->filiere_id)->get();

                    foreach($filieres as $filiere){
                        if (in_array($filiere, $filieress)) {
                            continue;
                        }
                        else{
                            array_push($filieress,$filiere);
                        }
               }
           } 
        }
          
        }
        //return response()->json( $test);
        
        return view(
            'questions.create',
            ['filieres' => $filieress]
        );
    }

    public function store(Request $request)
    {

        $counts = array_count_values($request->reponse);

        if (count($request->proposition) <= 1) {
            $request->session()->flash('errorStatus', 'inserer aumoins deux proposition ');
        } else {
            $question = new Question();
            $chapitre = Chapitre::get()->where('nom_chapitre', mb_strtoupper(request('chapitre')))->first();
            $question->chapitre_id = $chapitre->id;
            //return response()->json('haaa chapitre => '+ $chapitre);
            $question->question = request('question');
            $question->difficulte = request('difficulte');
            $question->note = request('note');
            $question->user()->associate(Auth::user());
            $question->vote=0;

            if ($counts[1] > 1) {
                $question->type = 'multi';
            }
            $question->save();
            $lastid = $question->id;
            if (count($request->proposition) > 0) {
                foreach ($request->proposition as $propositon => $p) {

                    $propositions = array(

                        'question_id' => $lastid,
                        'proposition' => $request->proposition[$propositon],
                        'reponse' => $request->reponse[$propositon]
                    );
                    Proposition::insert($propositions);
                }
            }
        }
    }

    public function edit()
    {
        return view('questions.edit');
    }

    public function update(Request $request)
    {
        $id =  $request->get('question_id');
        $question =  $request->get('question');
        // $duree =  $request->get('duree');
        $note =  $request->get('note');
        $difficulte =  $request->get('difficulte');
        $propositions =  $request->get('propositions');
        
        $quest = Question::find($id);
        $propositions_to_delete = Proposition::get()->where('question_id',$id);
        foreach($propositions_to_delete as $p){
            //$p->delete();
        }
        // $quest->duree = $duree;
        $quest->note = $note;
        $quest->question = $question;
        $quest->difficulte = $difficulte;
        //$quest->save();
        $rep = $request->get('reponses');
        return response()->json($rep);
        
        foreach($propositions as $prop => $props){
            $proposition = new Proposition();
            $proposition->question_id=$id;
            $proposition->proposition = $props;
            $proposition->reponse = $rep[$prop];
            
            // $proposition->save();
           
        }
        
    
    }
    public function destroy()
    {
    }



    public function findModuleByFiliere(Request $request)
    {
        $this->validate($request, ['nom_filiere' => 'required|exists:filieres,nom_filiere']);
        $filiereExistant = Filiere::get()->where('nom_filiere', mb_strtoupper($request->get('nom_filiere')))->first();
        $semestresFiliere=Semestre::get()->where('filiere_id', $filiereExistant->id);
        $data = array();
        foreach ($semestresFiliere as $semestre) {
            $array_semestre_module = SemestreModule::get()->where('semestre_id', $semestre->id);
            foreach($array_semestre_module as $semestre_module){
                $moduleExistant=Module::get()->where('id', $semestre_module->module_id)->first();
                array_push($data,$moduleExistant );
            }
        }
        $modulesData['data'] = $data;
        return json_encode($modulesData);
    }



    public function findChapitreByModule(Request $request)
    {
        // $this->validate($request, ['nom_module' => 'required|exists:modules,nom_module']);
        $modules = Module::get()->where('nom_module', $request->get('nom_module'))->first();
        // return response()->json($modules->id);
        // return response()->json($modules);
        $data = array();
        $chapitres = [];
        $chapitres = Chapitre::get()->where('module_id', $modules->id);

        foreach ($chapitres as $chap) {
            array_push($data, $chap);
        }
        $chapitresData['data'] = $data;

        return json_encode($chapitresData);
    }

    public function validateQuestions()
    {
        $this->authorize('validate',Question::class);
        $questions = Question::paginate(5);
        return view('questions.validations')->with(['questions' => $questions]);
    }

    public function changeValidation(Request $request)
    {
        $question = Question::find($request->input('id'));
        if (!$question) {
            return response()->json(['status' => 'NOT_FOUND']);
        }

        $question->validite = $request->input('validity');
        $question->save();
        return response()->json(['status' => 'UPDATE_SUCCESS']);
    }

    public function voted(Request $request)
    {
        $question = Question::find($request->get('id_question'));
        if (!$question) {
            return response()->json(['status' => 'NOT_FOUND']);
        }
        $question->vote+=1;
        $question->save();
        $currentProf=User::find(Auth::user()->id);
        $question_prof=new QuestionProfessor();
        $question_prof->question()->associate($question);
        $question_prof->professor()->associate($currentProf);
        $question_prof->save();
        //$question_prof=QuestionProfessor::get()->where('question_id',$question->id)->where('professor_id',$currentProf->id)->first();
        return response()->json(['status' => 'UPDATE_SUCCESS']);
    }
    public function devoted(Request $request)
    {
        $question = Question::find($request->get('id_question'));
        if (!$question) {
            return response()->json(['status' => 'NOT_FOUND']);
        }
        $question->vote-=1;
        $question->save();
        $currentProf=User::find(Auth::user()->id);
        $question_prof=QuestionProfessor::get()->where('question_id',$question->id)->where('professor_id',$currentProf->id)->first();
        QuestionProfessor::destroy($question_prof->id);
        return response()->json(['status' => 'UPDATE_SUCCESS']);
    }

    public function findQuestionByChapitreId(Request $request){
        $chapitre = Chapitre::get()->where('id', $request->get('chapitre_id'))->first();
        $data = array();
        $questions = [];
        $questions = Question::where('chapitre_id', $chapitre->id)->with('propositions')->get();
        
        foreach ($questions as $question) {
            array_push($data, $question);
        }
        $questionsData['data'] = $data;

        return json_encode($questionsData);
    }

    public function deleteQuestionById(Request $request){
        $propositions = Proposition::get()->where('question_id',$request->get('question_id'));
        
        foreach($propositions as $p){
            $p->delete();
        }
        Question::destroy($request->get('question_id'));
        return response()->json('question deleted ... ! ');
    }
    public function findPropositionsByQuestionId(Request $request){
        $props = Proposition::get()->where('question_id',$request->get('question_id'));
        $propositions['data']=$props;
        return json_encode($propositions);
    }

}
