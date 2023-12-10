<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Setting;
use App\Models\Section;
use App\Models\Grade;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $grades = Grade::with('students')->get();
        $sections = Section::with('grade', 'students')->get();
        
        $datas = [];

        foreach($grades as $grade){
            $male_count = $grade->students->where('gender', 'male')->count();
            $female_count = $grade->students->where('gender','female')->count();
            

            $datas[] = [
                'grade_name' => $grade->name,
                'grade_students_count' => $grade->students->count(),
                'grade_students_male_count' => $male_count,
                'grade_students_female_count' => $female_count,
                'old_students_count' => $grade->students->where('student_type', 'old')->count(),
                'new_students_count' => $grade->students->where('student_type', 'new')->count(),
                'transferred_students_count' => $grade->students->where('student_type', 'transferee')->count(),
                'balik_aral_students_count' => $grade->students->where('student_type', 'balik_aral')->count(),
            ];
        }
        

        return view('report.index', compact('setting', 'sections', 'grades', 'datas'));
    }

    public function getStatistics(Request $request)
    {
        $from = $request->from ?? '2021-01-01'; // '2021-01-01' is the default value
        $to = $request->to ?? '2025-12-31'; // '2021-12-31' is the default value

        $grades = Grade::with(['students' => function ($query) use ($from, $to) {
            $query->whereBetween('enrolled_at', [Carbon::parse($from), Carbon::parse($to)]);
        }])->get();

        $sections = Section::with(['grade', 'students' => function ($query) use ($from, $to) {
            $query->whereBetween('enrolled_at', [Carbon::parse($from), Carbon::parse($to)]);
        }])->get();

        $datas = [];

        foreach ($grades as $grade) {
            $male_count = $grade->students->where('gender', 'male')->count();
            $female_count = $grade->students->where('gender', 'female')->count();

            $datas[] = [
                'grade_name' => $grade->name,
                'grade_students_count' => $grade->students->count(),
                'grade_students_male_count' => $male_count,
                'grade_students_female_count' => $female_count,
                'old_students_count' => $grade->students->where('student_type', 'old')->count(),
                'new_students_count' => $grade->students->where('student_type', 'new')->count(),
                'transferred_students_count' => $grade->students->where('student_type', 'transferee')->count(),
                'balik_aral_students_count' => $grade->students->where('student_type', 'balik_aral')->count(),
            ];
        }
        return response()->json([
            'datas' => $datas,
            'sections' => $sections,
            'grades' => $grades,
        ]);
    }
}
