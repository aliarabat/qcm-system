<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Niveau;
=======
use App\User;
use App\Role;
use App\Niveau;
use App\Filiere;
use App\Semestre;
use App\StudentSemestre;
>>>>>>> f70fd6da8d97b93ff7276143be195335a9ef0f2e
use Illuminate\Http\Request;

class AffectationStudentController extends Controller
{
<<<<<<< HEAD

    public function __construct()
    {
        $this->middleware('auth');
        
        
    }
    public function index()
    {
        $this->authorize('create',Niveau::class);
        return view('affectations.students.index');
=======
    private $allStudents;
    private $niveaux;

    public function index()
    {
        $this->allStudents = User::get()->where('role_id', 3);
        $this->niveaux = Niveau::all();
        $studentSemestres = StudentSemestre::paginate(5);
        return view('affectations.students.index', ['students' => $this->allStudents, 'niveaux' => $this->niveaux, 'studentSemestres' => $studentSemestres]);
>>>>>>> f70fd6da8d97b93ff7276143be195335a9ef0f2e
    }

    public function store(Request $request)
    {
<<<<<<< HEAD
        $this->authorize('create',Niveau::class);
        return response()->json('Hello');
=======
        $student = User::get()->where('id', $request->student)->first();
        $semestre_student_existant = StudentSemestre::get()->where('semestre_id', $request->semestre)->where('student_id', $request->student)->first();
        $semestres_student_existant = StudentSemestre::get()->where('student_id', $request->student)->first();
        if ($semestres_student_existant) {
            $semestre = Semestre::get()->where('id', $semestres_student_existant->semestre_id)->first();
            $filiere = Filiere::get()->where('id', $semestre->filiere_id)->first();
            if ($filiere->id == $request->filiere) {
                if ($semestre_student_existant) {
                    $message = "Etudiant déjà affecté à ce semestre";
                    return $message;
                } else {
                    $semestreExistant = Semestre::get()->where('id', $request->semestre)->first();
                    $semestre_student_new = new StudentSemestre();
                    $semestre_student_new->semestre()->associate($semestreExistant);
                    $semestre_student_new->student()->associate($student);
                    $semestre_student_new->annee = $request->annee;
                    $semestre_student_new->save();
                    $message = "Etudiant associé à ce semestre";
                    return $message;
                }
            } else {
                $message = "Cette filière n'est pas appropriée à cet étudiant";
                return $message;
            }
        } else {
            $semestreExistant = Semestre::get()->where('id', $request->semestre)->first();
            $semestre_student_new = new StudentSemestre();
            $semestre_student_new->semestre()->associate($semestreExistant);
            $semestre_student_new->student()->associate($student);
            $semestre_student_new->annee = $request->annee;
            $semestre_student_new->save();
            $message = "Etudiant associé à ce semestre";
            return $message;
        }
>>>>>>> f70fd6da8d97b93ff7276143be195335a9ef0f2e
    }
}
