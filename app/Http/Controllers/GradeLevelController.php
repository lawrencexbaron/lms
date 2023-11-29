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
        return view('graderoom.create-rooms', compact('grades'));
    }

    public function StoreRoom(Request $request){

        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'status' => 'sometimes',
        ]);

        Room::create($request->all());

        return redirect()->route('graderoom.index')->with('roomsuccess', 'Room created successfully.');
    }

    public function StoreGradeLevel(Request $request){

        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        Grade::create($request->all());

        return redirect()->route('graderoom.index')->with('gradesuccess', 'Grade Level created successfully.');
    }

    public function GetRooms(Request $request){
        $search = $request->search ?? '';
        $page = $request->page ?? 1;
        $show = $request->show ?? 5;

        $rooms = Room::where('name', 'like', '%'.$search.'%')
            ->orWhere('code', 'like', '%'.$search.'%')
            ->orWhere('status', 'like', '%'.$search.'%')
            ->orderBy('id', 'asc')
            ->paginate($show, ['*'], 'page', $page);

        $response = [
            'rooms' => $rooms->items(),
            'total' => $rooms->total(),
            'total_pages' => $rooms->lastPage(),
            'current_page' => $rooms->currentPage(),
        ];

        return response()->json($response);
    }

    public function GetGrades(Request $request){
        
        $grades = Grade::all();

        return response()->json($grades); 
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
        return view('graderoom.edit-grades', compact('grade'));
    }

    public function EditRoom($id){
        $room = Room::find($id);
        $grades = Grade::all();
        return view('graderoom.edit-rooms', compact('room', 'grades'));
    }

    public function UpdateGradeLevel(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $grade = Grade::find($id);
        $grade->update($request->all());

        return redirect()->route('graderoom.index')->with('gradesuccess', 'Grade Level updated successfully.');
    }

    public function UpdateRoom(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'status' => 'sometimes',
        ]);

        $room = Room::findOrfail($id);
        $room->update($request->all());

        return redirect()->route('graderoom.index')->with('roomsuccess', 'Room updated successfully.');
    }

    public function DeleteGradeLevel(string $id){
        $grade = Grade::findOrfail($id);
        $grade->delete();
        
        return response()->json([
            'message' => 'Grade Level deleted successfully.',
            'status' => 'success'
        ]);
    }

    public function DeleteRoom($id){
        $room = Room::findOrfail($id);
        $room->delete();

        return response()->json([
            'message' => 'Room deleted successfully.',
            'status' => 'success'
        ]);
    }

    public function ViewGradeLevel($id){
        $grade = Grade::find($id);
        return view('graderoom.view-grade-level', compact('grade'));
    }

    public function ViewRoom($id){
        $room = Room::find($id);
        return view('graderoom.view-room', compact('room'));
    }

}
