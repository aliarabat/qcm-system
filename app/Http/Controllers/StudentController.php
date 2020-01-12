<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Mail\StudentCreated;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function index()
    {
        return view('students.index');
    }

    public function create(Request $request)
    {
        $data = $request->except('_token');
        if (count($data) > 2) {
            $oldStudent = User::where('email', $data['email'])->count();
            if ($oldStudent == 0) {
                $student = new User();
                $student->first_name = $data['first_name'];
                $student->last_name = $data['last_name'];
                $student->email = $data['email'];
                $student->password = Hash::make(UsersImport::random_string());
                $role = Role::where('name', 'STUDENT')->first();
                $student->role()->associate($role);
                $student->save();
                Mail::to($student)->send(new StudentCreated($student, $student->password));
                return response()->json('étudiant ajouté avec succés');
            }
            return response()->json('email already exist');
        }

        $uploadedFile = $request->file('file');
        if (!in_array($uploadedFile->getClientOriginalExtension(), ["xlsx", "xls"])) {
            return response()->json('machi excel');
        }
        (new UsersImport)->import($uploadedFile);

        return response()->json('users');
    }
}
