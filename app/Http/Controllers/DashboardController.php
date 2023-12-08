<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Section;

class DashboardController extends Controller
{
    //
    public function index(){
        $enrolled = Student::all()->count();
        $sections = Section::all()->count();
        $enrollees_today = Student::whereDate('created_at', date('Y-m-d'))->count();
        $archived = Student::onlyTrashed()->count();
        $this->setAppName(1, 'Dashboard');
        
        return view('dashboard', compact('enrolled', 'sections', 'enrollees_today','archived'));
    }
}
