<?php

namespace App\Http\Controllers;

use App\Imports\ProfessorImport;
use App\Imports\StudentImport;
use App\Mail\UserCreated;
use App\Niveau;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ProfessorController extends Controller
{
    public function index()
    {
        $this->authorize('create',Niveau::class);
        return view('professors.index');
    }

    public function store(Request $request)
    {
        $this->authorize('create',Niveau::class);
        // return response()->json($request->except('_token'));
        $data = $request->except('_token');
        if (count($data) > 2) {
            $oldStudent = User::where('email', $data['email'])->first();
            if ($oldStudent) {
                return response()->json(['status' => 'PROFESSOR_FOUND']);
            }
            $user = new User();
            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->email = $data['email'];
            $generatePwd = StudentImport::random_string();
            $user->password = Hash::make($generatePwd);
            $role = Role::where('name', 'PROFESSOR')->first();
            $user->role()->associate($role);
            $user->save();
            Mail::to($user)->send(new UserCreated($user, $generatePwd, 'professeur'));


            return response()->json(['status' => 'CREATED_SUCCESSFULLY']);
        }

        $uploadedFile = $request->file('file');
        if (!in_array($uploadedFile->getClientOriginalExtension(), ["xlsx", "xls"])) {
            return response()->json(['status' => 'INVALID_FILE_FORMAT']);
        }
        (new ProfessorImport)->import($uploadedFile);

        return response()->json(['status' => 'PROFESSORS_CREATED_SUCCESSFULLY']);
    }
}
