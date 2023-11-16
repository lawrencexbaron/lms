<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Section;
use App\Models\Grade;
use App\Models\SchoolYear;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $sections = Section::orderBy('name', 'desc')->with('grade', 'schoolyear')->get();
        return view('section.index', compact('sections'));
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
        return view('section.create', compact('teachers', 'grade_levels', 'school_years'));
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
        $section = Section::findOrFail($id)->with('grade', 'schoolyear', 'adviser')->first();
        return view('section.show', compact('section'));
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

        return view('section.edit', compact('section', 'teachers', 'grade_levels', 'school_years'));
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

        return redirect()->route('sections.index')->with('status', 'Section deleted successfully.');
    }
}
