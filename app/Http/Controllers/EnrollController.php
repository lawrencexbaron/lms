<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use App\Models\Student;
use App\Models\StudentParent;
use App\Models\StudentAddress;
use App\Models\Grade;

class EnrollController extends Controller
{
    //
    public function enrolled(Request $request) : View
    {
        return view('enroll.index', [
            'user' => $request->user(),
        ]);
    }

    public function enroll(Request $request) : View
    {
        $grades = Grade::all();

        return view('enroll.enroll', [
            'user' => $request->user(),
        ], compact('grades'));
    }

    public function EnrollSuccess(Request $request, $id) : View
    {
    
        // get url parameters
        $student = Student::where('student_number', $id)->with('grade')->firstOrFail();

        return view('enroll.success', [
            'user' => $request->user(),
        ], compact('student'));
    }

    public function EnrolledStudents(Request $request, $id) : JsonResponse
    {
        try{
            // get url parameters
            $grade = Grade::where('id', $id)->firstOrFail();

            // get students
            $students = Student::where('grade_level_id', $grade->id)->get();

            // return response
            return response()->json([
                'success' => true,
                'data' => $students,
                'message' => 'Successfully fetched enrolled students.',
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'errors' => $e->errors(),
                'message' => 'Failed to fetch enrolled students.',
            ], 500);
        }
    }

    public function EnrolledStudentsView(Request $request, $id) : View
    {
        // get url parameters
        $grade = Grade::where('id', $id)->firstOrFail();

        // get students
        $students = Student::where('grade_level_id', $grade->id)->get();

        return view('enroll.enrolled', [
            'user' => $request->user(),
        ], compact('students', 'grade'));
    }

    public function enrollPost(Request $request) : JsonResponse
    {
        try{
            // validate request and json response
            $validate = $request->validate([
                // step 1
                'grade_level' => 'sometimes|exists:grades,id',
                'student_type' => 'required|in:new,old,transferee,balik_aral',
                'psa_no' => 'required|string',
                'lrn' => 'sometimes|string',
                'learner_status' => 'required|string',
                'first_name' => 'required|string',
                'middle_name' => 'required|string',
                'last_name' => 'required|string',
                'extension_name' => 'required|string',
                'date_of_birth' => 'required|date',
                'place_of_birth' => 'required|string',
                'gender' => 'required|in:male,female',
                'contact_number' => 'sometimes|string',
                'mother_tongue' => 'required|string',
                'house_no' => 'required|string',
                'street' => 'required|string',
                'barangay' => 'required|string',
                'city_municipality' => 'required|string',
                // step 2
                'father_name' => 'sometimes',
                'father_contact_number' => 'sometimes',
                'mother_name' => 'sometimes',
                'mother_contact_number' => 'sometimes',
                'guardian_name' => 'sometimes',
                'guardian_contact_number' => 'sometimes',
                // step 3
                'learning_modules' => 'required|array',
                'gwa' => 'required|string',
                'previous_section' => 'required|string',
            ]);

            // create student
            $student = new Student();
            $student->student_number = 'STU-'.rand(100000, 999999);
            $student->lrn = $validate['lrn'];
            $student->psa_no = $validate['psa_no'];
            $student->grade_level_id = $validate['grade_level'];
            $student->learner_status = $validate['learner_status'];
            $student->first_name = $validate['first_name'];
            $student->middle_name = $validate['middle_name'];
            $student->last_name = $validate['last_name'];
            $student->suffix = $validate['extension_name'];
            $student->birthdate = $validate['date_of_birth'];
            $student->student_type = $validate['student_type'];
            $student->gender = $validate['gender'];
            $student->place_of_birth = $validate['place_of_birth'];
            $student->contact_number = $validate['contact_number'] ?? null;
            $student->previous_sy_attended = $validate['previous_sy_attended'] ?? null;
            $student->previous_level = $validate['previous_level'] ?? null;
            $student->previous_section = $validate['previous_section'] ?? null;
            $student->mother_tongue = $validate['mother_tongue'];
            $student->gwa = $validate['gwa'];
            $student->learning_modules = json_encode($validate['learning_modules']);
            $student->save();

            // create student address
            $studentAddress = new StudentAddress();
            $studentAddress->student_id = $student->id;
            $studentAddress->house_no = $validate['house_no'];
            $studentAddress->street = $validate['street'];
            $studentAddress->barangay = $validate['barangay'];
            $studentAddress->city_municipality = $validate['city_municipality'];
            $studentAddress->save();

            // create student parent
            $studentParent = new StudentParent();
            $studentParent->student_id = $student->id;
            $studentParent->father_name = $validate['father_name'];
            $studentParent->father_contact_number = $validate['father_contact_number'];
            $studentParent->mother_name = $validate['mother_name'];
            $studentParent->mother_contact_number = $validate['mother_contact_number'];
            $studentParent->guardian_name = $validate['guardian_name'];
            $studentParent->guardian_contact_number = $validate['guardian_contact_number'];
            $studentParent->save();

            // return response
            return response()->json([
                'success' => true,
                'data' => $student,
                'message' => 'Successfully enrolled student.',
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'errors' => $e->errors(),
                'message' => 'Failed to enroll student.',
            ], 500);
        }
    }
}
