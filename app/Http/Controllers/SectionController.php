<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Section;
use App\Models\Grade;
use App\Models\Student;
use App\Models\SchoolYear;
use App\Models\Room;
use Illuminate\Support\Facades\View;
use App\Exports\SectionExport;
use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Dompdf;
use PDF;
use App\Models\Setting;

class SectionController extends Controller
{
    public function exportExcel(Request $request) 
    {
        $section_id = $request->query('section_id');
        $section = Section::findOrFail($section_id);
        // export to xlsx add the section name to the filename
        return Excel::download(new SectionExport($section_id), 'Section-' . $section->id . '-' . $section->name . '.xlsx');
        
    }

    public function exportPDF(Request $request) 
    {
        $section_id = $request->query('section_id');
        $section = Section::with('grade', 'adviser')->findOrFail($section_id);
        $setting = Setting::first();

        $students = Student::where('section_id', $section_id)->with('grade', 'section')->get();

        $pdf = \PDF::loadView('pdf.section', compact('section', 'students', 'setting'));
        return $pdf->download('Section-' . $section->id . '-' . $section->name . '.pdf');

    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // retrieve search term, page and limit from url
        $search = $request->search ?? '';
        $page = $request->page ?? 1;
        $limit = $request->limit ?? 5;

        // get paginated sections
        $sections = Section::where('name', 'like', '%'.$search.'%')
            ->orWhere('section_code', 'like', '%'.$search.'%')
            ->orWhere('section_description', 'like', '%'.$search.'%')
            ->orWhere('status', 'like', '%'.$search.'%')
            ->orderBy('name', 'asc')
            ->with('grade', 'schoolyear')
            ->paginate($limit, ['*'], 'page', $page);

        if ($request->ajax()) {
            return view('section.table', compact('sections'));
        }
        $this->setAppName(1, 'Sections');

        return view('section.index', compact('sections'));

    }
    public function SectionsView(Request $request, $id){
        $section = Section::with('grade', 'schoolyear', 'adviser', 'room', 'students')->findOrFail($id);
        $students = Student::where('section_id', $id)->where('grade_level_id', $section->grade_level_id)->get();

        $this->setAppName(1, 'Sections');

        return view('section.view', compact('section', 'students'));
    }

    public function getSections(Request $request){
        // retrieve search term, page and limit from url
        $search = $request->search ?? '';
        $page = $request->page ?? 1;
        $show = $request->show ?? 5;

        // get paginated sections
        $sections = Section::where('name', 'like', '%'.$search.'%')
            ->orWhere('section_code', 'like', '%'.$search.'%')
            ->orWhere('section_description', 'like', '%'.$search.'%')
            ->orWhere('status', 'like', '%'.$search.'%')
            ->orWhere('capacity', 'like', '%'.$search.'%')
            ->orWhereRelation('adviser', 'first_name', 'like', '%'.$search.'%')
            ->orWhereRelation('adviser', 'last_name', 'like', '%'.$search.'%')
            ->orWhereRelation('grade', 'name', 'like', '%'.$search.'%')
            ->orderBy('id', 'asc')
            ->with('grade', 'schoolyear', 'adviser', 'room')
            ->paginate($show, ['*'], 'page', $page);

        $response = [
            'sections' => $sections->items(),
            'total' => $sections->total(),
            'total_pages' => $sections->lastPage(),
            'current_page' => $sections->currentPage(),
        ];

        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $teachers = User::where('role', 'teacher')->get();
        $grade_levels = Grade::where('status', 'active')->get();
        $school_years = SchoolYear::where('status', 'active')->get();
        $rooms = Room::where('status', 'active')->get();
        return view('section.create', compact('teachers', 'grade_levels', 'school_years', 'rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate inputs
        $request->validate([
            'name' => 'required',
            'capacity' => 'required',
            'adviser_id' => 'required',
            'grade_level_id' => 'required',
            'room_id' => 'required',
            'school_year_id' => 'required',
            'section_code' => 'required',
            'section_description' => 'required',
            'status' => 'sometimes',
        ]);

        // create new section
        $section = Section::create([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'adviser_id' => $request->adviser_id,
            'grade_level_id' => $request->grade_level_id,
            'room_id' => $request->room_id,
            'school_year_id' => $request->school_year_id,
            'section_code' => $request->section_code,
            'section_description' => $request->section_description,
            'status' => $request->status,
        ]);

        // redirect to sections.index
        return redirect()->route('sections.index')->with('status', 'Section created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $section = Section::findOrFail($id)->with('grade', 'schoolyear', 'adviser', 'room')->first();
        $grades = Grade::all();

        return view('section.show', compact('section', 'grades'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $section = Section::findOrFail($id);
        $teachers = User::where('role', 'teacher')->get();
        $grade_levels = Grade::where('status', 'active')->get();
        $school_years = SchoolYear::where('status', 'active')->get();
        $rooms = Room::where('status', 'active')->get();

        return view('section.edit', compact('section', 'teachers', 'grade_levels', 'school_years', 'rooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate inputs
        $request->validate([
            'name' => 'required',
            'capacity' => 'required',
            'adviser_id' => 'required',
            'grade_level_id' => 'required',
            'school_year_id' => 'required',
            'room_id' => 'required',
            'section_code' => 'required',
            'section_description' => 'required',
            'status' => 'sometimes',
        ]);

        // update section
        $section = Section::findOrFail($id);
        $section->update([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'adviser_id' => $request->adviser_id,
            'grade_level_id' => $request->grade_level_id,
            'room_id' => $request->room_id,
            'school_year_id' => $request->school_year_id,
            'section_code' => $request->section_code,
            'section_description' => $request->section_description,
            'status' => $request->status,
        ]);

        // redirect to sections.index
        return redirect()->route('sections.index')->with('status', 'Section updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $section = Section::findOrFail($id);
        $section->delete();

        return response()->json([
            'message' => ' Sectiondeleted successfully.',
            'status' => 'success',
        ]);
    
    }
}
