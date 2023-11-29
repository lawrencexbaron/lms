<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Module;

class StudentController extends Controller
{
    //

    public function show($id){
        $student = Student::with('parent', 'address', 'modules')->findOrfail($id);
        $modules = Module::all();

        return view('student.show', compact('student', 'modules'));
    }
}
