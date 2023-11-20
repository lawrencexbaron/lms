<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Room;

class GradeLevelController extends Controller
{
    //
    public function index(){
        return view('graderoom.index');
    }

    public function CreateGradeLevel(){
        return view('graderoom.create-grades');
    }

    public function CreateRoom(){
        $grades = Grade::all();
        return view('graderoom.create-room', compact('grades'));
    }

    public function StoreRoom(Request $request){

        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'grade_level_id' => 'required',
        ]);

        Room::create($request->all());

        return redirect()->route('graderoom.index')->with('success', 'Room created successfully.');
    }

    public function StoreGradeLevel(Request $request){

        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        Grade::create($request->all());

        return redirect()->route('graderoom.index')->with('gradesuccess', 'Grade Level created successfully.');
    }

    public function GetGradeLevels(Request $request){
        $search = $request->search ?? '';
        $page = $request->page ?? 1;
        $show = $request->show ?? 5;

        $grades = Grade::where('name', 'like', '%'.$search.'%')
            ->orWhere('status', 'like', '%'.$search.'%')
            ->orderBy('id', 'asc')
            ->paginate($show, ['*'], 'page', $page);

        $response = [
            'grades' => $grades->items(),
            'total' => $grades->total(),
            'total_pages' => $grades->lastPage(),
            'current_page' => $grades->currentPage(),
        ];

        return response()->json($response);
    }

    public function EditGradeLevel($id){
        $grade = Grade::find($id);
        return view('graderoom.edit-grade-level', compact('grade'));
    }

    public function EditRoom($id){
        $room = Room::find($id);
        $grades = Grade::all();
        return view('graderoom.edit-room', compact('room', 'grades'));
    }

    public function UpdateGradeLevel(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $grade = Grade::find($id);
        $grade->update($request->all());

        return redirect()->route('graderoom.index')->with('success', 'Grade Level updated successfully.');
    }

    public function UpdateRoom(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'grade_level_id' => 'required',
        ]);

        $room = Room::find($id);
        $room->update($request->all());

        return redirect()->route('graderoom.index')->with('success', 'Room updated successfully.');
    }

    public function DeleteGradeLevel($id){
        $grade = Grade::find($id);
        $grade->delete();

        return redirect()->route('graderoom.index')->with('success', 'Grade Level deleted successfully.');
    }

    public function DeleteRoom($id){
        $room = Room::find($id);
        $room->delete();

        return redirect()->route('graderoom.index')->with('success', 'Room deleted successfully.');
    }

    public function ViewGradeLevel($id){
        $grade = Grade::find($id);
        return view('graderoom.view-grade-level', compact('grade'));
    }

    public function ViewRoom($id){
        $room = Room::find($id);
        return view('graderoom.view-room', compact('room'));
    }

    public function getGrades(){
        $grades = Grade::all();
        
        return response()->json([
            'grades' => $grades
        ]);
    }

    public function getRooms(){
        $rooms = Room::all();
        
        return response()->json([
            'rooms' => $rooms
        ]);
    }
}
