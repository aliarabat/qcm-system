<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function index()
    {
        return view('students.index');
    }

    public function create(Request $request)
    {
        // return response()->json('hada excel');
        $data = $request->all();
        if (count($data) > 2) {
            return response()->json('hada machi excel');
        }

        $uploadedFile = $request->file('file');
        if (!in_array($uploadedFile->getClientOriginalExtension(), ["xlsx", "xls"])) {
            return response()->json('machi excel');
        }
        (new UsersImport)->import($uploadedFile);

        return response()->json('users');
    }
}
