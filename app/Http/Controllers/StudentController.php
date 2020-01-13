<?php

namespace App\Http\Controllers;

use App\Imports\StudentImport;
use App\Mail\UserCreated;
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

    public function store(Request $request)
    {
        $data = $request->except('_token');
        if (count($data) > 2) {
            $oldStudent = User::where('email', $data['email'])->first();
            if ($oldStudent) {
                return response()->json(['status'=>'STUDENT_FOUND']);
            }
            $student = new User();
            $student->first_name = $data['first_name'];
            $student->last_name = $data['last_name'];
            $student->email = $data['email'];
            $generatePwd=StudentImport::random_string();
            $student->password = Hash::make($generatePwd);
            $role = Role::where('name', 'STUDENT')->first();
            $student->role()->associate($role);
            $student->save();
            Mail::to($student)->send(new UserCreated($student, $generatePwd, 'étudiant'));

            return response()->json(['status'=>'CREATED_SUCCESSFULLY']);
        }

        $uploadedFile = $request->file('file');
        if (!in_array($uploadedFile->getClientOriginalExtension(), ["xlsx", "xls"])) {
            return response()->json('INVALID_FILE_FORMAT');
        }
        (new StudentImport)->import($uploadedFile);

        return response()->json(['status'=>'STUDENTS_CREATED_SUCCESSFULLY']);
    }
}
