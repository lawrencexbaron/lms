<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Module;
use App\Models\Grade;

class StudentController extends Controller
{
    //

    public function show($id){
        $student = Student::with('parent', 'address', 'modules', 'modules')->findOrfail($id);
        $modules = Module::all();
        $grades = Grade::all();

        return view('student.show', compact('student', 'modules', 'grades'));
    }

    public function update(Request $request, $id){
        $student = Student::with('parent', 'address', 'modules')->findOrfail($id);
        $student->lrn = $request->lrn;
        $student->psa_no = $request->psa_no;
        $student->grade_level_id = $request->grade_level;
        $student->learner_status = $request->learner_status;
        $student->first_name = $request->first_name;
        $student->middle_name = $request->middle_name;
        $student->last_name = $request->last_name;
        $student->suffix = $request->extension_name;
        $student->birthdate = $request->date_of_birth;
        $student->student_type = $request->student_type;
        $student->gender = $request->gender;
        $student->place_of_birth = $request->place_of_birth;
        $student->contact_number = $request->contact_number;
        $student->previous_sy_attended = $request->previous_sy_attended;
        $student->previous_level = $request->previous_level;
        $student->previous_section = $request->previous_section;
        $student->mother_tongue = $request->mother_tongue;
        $student->gwa = $request->gwa;

        // update address relation
        $student->address->house_no = $request->house_no;
        $student->address->street = $request->street;
        $student->address->barangay = $request->barangay;
        $student->address->city_municipality = $request->city_municipality;
        $student->address->save();
        
        // update parent relation
        $student->parent->father_name = $request->father_name;
        $student->parent->father_contact_number = $request->father_contact_number;
        $student->parent->mother_name = $request->mother_name;
        $student->parent->mother_contact_number = $request->mother_contact_number;
        $student->parent->guardian_name = $request->guardian_name;
        $student->parent->guardian_contact_number = $request->guardian_contact_number;
        $student->parent->save();

        // save student modules by detaching all modules first
        $student->modules()->detach();
        $student->modules()->attach($request->modules);


        $student->save();
        return response()->json(['message' => 'Student updated successfully'], 200);
        // return redirect()->back()->with('success', 'Student updated successfully');
    }
    public function destroy($id){
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->back()->with('success', 'Student deleted successfully');
    }
}
