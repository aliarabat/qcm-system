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
use App\Response;
use App\SemestreModuleProf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Throwable;

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
        $qcm_users = QcmUsers::where(['user_id' => Auth::user()->id, 'is_passed' => false])->get();
        $qcms = [];
        // dd($qcm_users);
        foreach ($qcm_users as  $qcm_user) {
            $qcm = $qcm_user->qcm;
            array_push($qcms, $qcm);
        }
        // foreach ($qcms as  $qcm) {
        //     echo $qcm->description;
        // }
        return view('evaluations.dashboard.students', ['qcms' => $qcms]);
    }

    public function create()
    {
        $modules = Module::all();
        return view(
            'evaluations.create',
            ['modules' => $modules]
        );
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
        $chapitress = $datac['chapitres'];

        // $nbrQstDiff = 0;
        // $nbrQstFaNo = 0;
        // $nbr = 0;
        // $countDiff = 0;
        // $chapitre = '';
        // $d = 0;
        // $diff = 0;


        $questionsData = [];
        for ($i = 0; $i < sizeof($chapitress); $i++) {
            $data = [];
            $questionsFN = [];
            $questions = [];
            $chapitre = $chapitress[$i]["chapitre"];
            $chapitres = Chapitre::get()->where('nom_chapitre', mb_strtoupper($chapitre))->first();

            $questions = Question::get()->shuffle()->where('chapitre_id', $chapitres->id);
            $qstDiff = Question::get()->where('chapitre_id', $chapitres->id)->where('difficulte', 'Difficile');
            $countDiff = $qstDiff->count();

            foreach ($questions as $question) {

                if ($question->difficulte == "Difficile") {
                    array_push($data, $question);
                } else {
                    array_push($questionsFN, $question);
                }
            }

            $countChap = count($chapitress);
            $diff = (int) ($request->input('difficulte') / $countChap);
            $nbr = $chapitress[$i]["nbrQuestion"];
            $nbrQstDiff = ceil((($nbr * $diff) / 100));
            $d = $countDiff - $nbrQstDiff;

            if ($d >= 0) {
                $nbrQstFaNo = $nbr - $nbrQstDiff;
            } elseif ($d < 0) {
                $nbrQstFaNo = ($nbr - $nbrQstDiff) + ($nbrQstDiff - $countDiff);
            }

            $questionsData = array_merge($questionsData, array_slice($questionsFN, 0, $nbrQstFaNo), array_slice($data, 0, $nbrQstDiff));
        }
        return response()->json($questionsData);
    }

    public function start($qcmId)
    {
        $isPassed = QcmUsers::where(['qcm_id' => $qcmId, 'user_id' => Auth::user()->id])->first()->value('is_passed');
        if ($isPassed) {
            Auth::logout();
            return redirect()->route('login');
        }
        $qcm = Qcm::find($qcmId)->first();
        $qcm['questions'] = Question::find($qcm->reference)->get()->shuffle();
        foreach ($qcm['questions'] as $key => $question) {
            $question->propositions = $question->propositions->shuffle();
        }

        return view('evaluations.evaluate', compact(['qcm']));
    }

    public function end(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->except('_token');
            try {
                $note=0;
                for ($i = 0; $i < sizeof($data['data']); $i++) {
                    $choice = $data['data'][$i];
                    $response=Response::create([
                        'responses' => implode("-", $choice['propositions']),
                        'qcm_users_id' => $data['quuid'],
                        'question_id' => $choice['question_id'],
                    ]);
                    // $propositions=Question::find($choice['question_id'])->propositions()->where('reponse', true)->get();
                    // $responses = [];
                    // foreach ($propositions as  $prop) {
                    //     array_push($responses, $prop->id);
                    // }

                    // $diffs=array_diff($propositions, $choice['propositions']);
                    // if (count($diffs)==0 && count($choice['propositions'])==count(array_push($responses, $prop->id))) {
                    //     $note++;
                    // }
                }

                // return response()->json($note);
                Auth::logout();
                return response()->json(['route' => route('login')]);
            } catch (Throwable $th) {
                return response()->json(['status' => 'ERROR']);
            }
        }
    }

    public function passed($qcmId)
    {
        $qcm_user = QcmUsers::where(['qcm_id' => $qcmId, 'user_id' => Auth::user()->id])->first();
        $qcm_user->is_passed = true;
        $qcm_user->save();
        return response()->json($qcm_user->is_passed);
    }

    public function showResults()
    {
        $semModuProfs = SemestreModuleProf::where('professor_id', Auth::user()->id)->get();
        $results = [];
        foreach ($semModuProfs as $smp) {
            array_push($results, Qcm::find($smp->id)->first());
        }
        return view('evaluations.dashboard.professors', ['qcms' => $results]);
    }

    public function getResults(Request $request)    
    {
        $qcm_users=QcmUsers::where('qcm_id', $request->input('quuid'))->with('user')->get();
        return response()->json(compact('qcm_users'));
    }
}
