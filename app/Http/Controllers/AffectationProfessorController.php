<?php
namespace App\Http\Controllers;
use App\User;
use App\Role;
use App\Niveau;
use App\Filiere;
use App\Semestre;
use App\Module;
use App\semestreModule;
use App\SemestreModuleProf;
use Illuminate\Http\Request;
class AffectationProfessorController extends Controller
{
    private $allProfs;
    private $niveaux;
    public function index()
    {
        $this->authorize('create',Niveau::class);
        //role prof: App\Role::get()->where('name','PROFESSOR')->first()->id
        $this->allProfs = User::get()->where('role_id', 2);
        $this->niveaux = Niveau::all();
        $semestreModuleProfs = SemestreModuleProf::paginate(5);
        return view('affectations.professors.index', ['profs' => $this->allProfs, 'niveaux' => $this->niveaux, 'semestreModuleProfs' => $semestreModuleProfs]);
    }
    public function store(Request $request)
    {
        $semestre_module_existant = semestreModule::get()->where('semestre_id', $request->semestre)->where('module_id', $request->module)->first();
        $semestre_module_prof_existant = SemestreModuleProf::get()->where('semestre_module_id', $semestre_module_existant->id)->first();
        if ($semestre_module_prof_existant) {
            $prof = User::get()->where('id', $request->professor)->first();
            $semestre_module_prof_existant->professor()->associate($prof);
            $semestre_module_prof_existant->annee = $request->annee;
            $semestre_module_prof_existant->save();
            $message = "Nouveau professeur associé à ce module";
            return $message;
        } else {
            $semestre_module_prof_new = new SemestreModuleProf();
            $semestre_module_prof_new->semestreModule()->associate($semestre_module_existant);
            $prof = User::get()->where('id', $request->professor)->first();
            $semestre_module_prof_new->professor()->associate($prof);
            $semestre_module_prof_new->annee = $request->annee;
            $semestre_module_prof_new->save();
            $message = "Professeur associé à ce module";
            return $message;
        }
    }
    public function filieresNiveau(Request $request)
    {
        //$this->validate($request, ['niveau' => 'required|exists:niveaux,niveau']);
        $selectNiveau = $request->get('niveau');
        $filieresExistants = Filiere::get()->where('niveau_id', $selectNiveau);
        $data = array();
        foreach ($filieresExistants as $filiere) {
            array_push($data, $filiere);
        }
        $filieresData['data'] = $data;
        return json_encode($filieresData);
    }
    public function semestresFiliere(Request $request)
    {
        //$this->validate($request, ['nom_filiere' => 'required|exists:filieres,nom_filiere']);
        $selectFiliere = $request->get('filiere');
        $semestresFiliere = Semestre::get()->where('filiere_id', $selectFiliere);
        $data = array();
        foreach ($semestresFiliere as $semestre) {
            array_push($data, $semestre);
        }
        $semestresData['data'] = $data;
        return json_encode($semestresData);
    }
    public function modulesSemestre(Request $request)
    {
        //$this->validate($request, ['nom_filiere' => 'required|exists:filieres,nom_filiere']);
        $selectSemestre = $request->get('semestre');
        $listSemestreModule = semestreModule::get()->where('semestre_id', $selectSemestre);
        $data = array();
        foreach ($listSemestreModule as $semestreModule) {
            $moduleExistant = Module::get()->where('id', $semestreModule->module_id)->first();
            array_push($data, $moduleExistant);
        }
        $modulesData['data'] = $data;
        return json_encode($modulesData);
    }
}