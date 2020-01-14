<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use App\Proposition;
use App\Filiere;
use App\Module;
use App\Chapitre;
use App\Qcm;
use App\AssocFiliereModule;
use App\QcmUsers;
use App\SemestreModuleProf;
use App\SemestreModule;
use App\Semestre;
use App\StudentSemestre;
use Illuminate\Support\Facades\Auth;

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
        $qcm_users = QcmUsers::where(['user_id'=>Auth::user()->id, 'is_passed'=>false])->get();
        $qcms=[];
        // dd($qcm_users);
        foreach ($qcm_users as  $qcm_user) {
            $qcm=$qcm_user->qcm;
            array_push($qcms, $qcm);
        }
        // foreach ($qcms as  $qcm) {
        //     echo $qcm->description;
        // }
        return view('evaluations.dashboard.students', ['qcms'=>$qcms]);
    }

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
                        array_push($filieress,$filiere);
               }
           } 
        }
          
        }
        //return response()->json( $test);
        
        return view(
            'evaluations.create',
            ['filieres' => $filieress]
        );
    }


    public function findSemesterByFiliere(Request $request)
    {
        $semestres = [];
        $this->validate($request, ['filiere_id' => 'required|exists:semestres,filiere_id']);
        $semestres1 = Semestre::where('filiere_id', mb_strtoupper($request->get('filiere_id')))->get();
         foreach ($semestres1 as $semestre) {
             $semestre_modules = SemestreModule::where('semestre_id', $semestre->id)->get();

             foreach ($semestre_modules as $semestre_module) {
                 $semestreModuleProfs = SemestreModuleProf::get()->where('professor_id', Auth::user()->id)->where('semestre_module_id', $semestre_module->id);

                 foreach ($semestreModuleProfs as $semestreModuleProf) {

                     $semestreModules = SemestreModule::where('id', $semestreModuleProf->semestre_module_id)->get();

                     foreach ($semestreModules as $semestreModule) {
                        $semestress = Semestre::where('id', $semestreModule->semestre_id)->get();

                        foreach($semestress as $s ){
                         array_push($semestres, $s);
                     }
                 }
             }
         }
        }
        $semestresData['data'] = $semestres;
        //return response()->json( ($request->get('filiere_id')));
       return json_encode($semestresData);
    }

    public function findModuleBySemestre(Request $request)
    {
        $modules = [];
        $this->validate($request, ['semestre_id' => 'required|exists:semestre_modules,semestre_id']);
        $semestre_modules1 =  SemestreModule::where('semestre_id', mb_strtoupper($request->get('semestre_id')))->get();
             foreach ($semestre_modules1 as $semestre_module1) {
                 $semestreModuleProfs = SemestreModuleProf::get()->where('professor_id', Auth::user()->id)->where('semestre_module_id', $semestre_module1->id);

                 foreach ($semestreModuleProfs as $semestreModuleProf) {

                     $semestreModules2 = SemestreModule::where('id', $semestreModuleProf->semestre_module_id)->get();

                     foreach ($semestreModules2 as $semestreModule2) {
                        $moduless = Module::where('id', $semestreModule2->module_id)->get();
                        
                        foreach($moduless as $m ){
                         array_push($modules, $m);
                     }
                 
             }
         }
        }
        $modulessData['data'] = $modules;
        //return response()->json( ($request->get('filiere_id')));
       return json_encode( $modulessData);
    }

    public function findChapitreByModule(Request $request)
    {
        $this->validate($request, ['nom_module' => 'required|exists:modules,nom_module']);
        $modules = Module::get()->where('nom_module', mb_strtoupper($request->get('nom_module')))->first();
        $data = array();
        $chapitres = [];
        $chapitres = Chapitre::get()->where('module_id', $modules->id);
            
        foreach ($chapitres as $chap) {
            array_push($data, $chap);
        }
        $chapitresData['data'] = $data;
        
        return json_encode($chapitresData);
    }

    public function store(Request $request)
    {
      
        $datac = $request->all();
        $chapitress = $datac['chapitres'] ;
       
           
            $questionsData = [];
            for ($i = 0; $i < sizeof($chapitress); $i++) {
            $data = [];
            $questionsFN = [];
            $questions = [];
            $chapitre = $chapitress[$i]["chapitre"];
            $chapitres = Chapitre::get()->where('nom_chapitre', mb_strtoupper($chapitre))->first();
       
            $questions = Question::get()->shuffle()->where('chapitre_id', $chapitres->id)->where('validite', 'valid');
            $qstDiff = Question::get()->where('chapitre_id', $chapitres->id)->where('difficulte', 'Difficile')->where('validite', 'valid');
            $countDiff = $qstDiff->count();
          
            foreach ($questions as $question) {
            
                if ($question->difficulte == "Difficile") {
                    array_push($data, $question);
                } else {
                    array_push($questionsFN, $question);
                }
            }

            $countChap = count($chapitress);
            $diff = (int)($request->input('difficulte')/$countChap);
            $nbr =$chapitress[$i]["nbrQuestion"];
            $nbrQstDiff = ceil((($nbr*$diff) / 100));
            $d =$countDiff- $nbrQstDiff ;
        
            if ($d >= 0) {
                $nbrQstFaNo = $nbr - $nbrQstDiff ;
            } elseif ($d < 0) {
                $nbrQstFaNo = ($nbr - $nbrQstDiff) + ($nbrQstDiff - $countDiff);
            }

            $questionsData =array_merge($questionsData,array_slice($questionsFN, 0, $nbrQstFaNo), array_slice($data, 0, $nbrQstDiff));
         
       
        }
        $module = Module::get()->where('nom_module', $request->input('module'))->first();
        $semestre_module =  SemestreModule::get()->where('semestre_id', $request->input('semestre'))->where('module_id',$module->id)->first();
        $semestre_module_prof =$semestreModuleProfs = SemestreModuleProf::get()->where('semestre_module_id', $semestre_module->id)->first();
        $qcm = new QCM();
        $qcm->semestre_module_professor_id	=  $semestre_module_prof->id;
        $qcm -> description = $request->input('description');
        $qcm->duration = $request->input('duree');
        $qcm->difficulty = $request->input('difficulte');
        $qcm->nbrQuestion = sizeof($questionsData);

           $ref = "";
            for($i = 0; $i < sizeof($questionsData); $i++){
                $qst=$questionsData[$i];
                if(sizeof($questionsData)-1 == $i){
                    $ref .=$qst->id;
                }else{
                    $ref .=$qst->id."-"; 
                }

                 
            }
            $qcm->reference = $ref;

        $qcm->save();

        $student_semestres =  StudentSemestre::get()->where('semestre_id', $request->input('semestre'));

        foreach($student_semestres as $student_semestre){
            $qcmUsers = new QcmUsers();
            $qcmUsers->	qcm_id = $qcm->id;
            $qcmUsers-> user_id	= $student_semestre->student_id; 
            $qcmUsers->save();

        }



    }




    public function start($id)
    {
        $isPassed=QcmUsers::where(['qcm_id'=>$id, 'user_id'=>Auth::user()->id])->first()->value('is_passed');
        if ($isPassed) {
            Auth::logout();
            return redirect()->route('login');
        }
        $qcm=Qcm::find($id)->first();
        $qcm['questions']=Question::find($qcm->reference)->get()->shuffle();
        foreach ($qcm['questions'] as $key => $question) {
            $question->propositions=$question->propositions->shuffle();
        }
        
        return view('evaluations.evaluate', compact(['qcm']));
    }

    public function end(Request $request)
    {
        $data=$request->input('data');
        Auth::logout();
        return redirect()->route('login');
    }

    public function passed($qcmId){
        $qcm_user=QcmUsers::where(['qcm_id'=>$qcmId, 'user_id'=>Auth::user()->id])->first();
        $qcm_user->is_passed=true;
        $qcm_user->save();
        return response()->json($qcm_user->is_passed);
    }
}
