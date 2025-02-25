<?php

namespace App\Http\Controllers;
use App\Models\Room;
use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index() {
        
        if (request()->ajax()) {
            $query = Room::select(
                'rooms.*'
            );
            return DataTables::make($query)->make(true);    
        }
        
        return view('room.index');
    }

    public function insertRoom(Request $request) {
         
        if (empty($request->input('_token'))) {
            return false;
        }

        $existingRoom = Room::where('building_name', $request->input('building_name'))
                    ->where('floor_number', $request->input('floor_number'))
                    ->where('room_number', $request->input('room_number'))
                    ->first();
        if ($existingRoom) {
            return redirect()->route('room.home')->with('error', 'Room already exists!');
        }

        Room::create($request->except('_token',));
        return redirect()->route('room.home')->with('success', 'Room created successfully!');
    }

    public function editRoom($id){
        $result = Room::select('rooms.*',)
                ->where('rooms.id', $id)
                ->first();
        return response()->json($result);
    }
    public function updateRoom(Request $request) {
        if (empty($request->input())) {
            return false;
        }

        if (empty($request->input('_token'))) {
            return false;
        }
        $id = $request->input('room_id');

        $room = Room::find($id);

        $existingRoom = Room::where('building_name', $request->input('building_name'))
                    ->where('floor_number', $request->input('floor_number'))
                    ->where('room_number', $request->input('room_number'))
                    ->first();
        if ($existingRoom) {
            return redirect()->route('room.home')->with('error', 'Room already exists!');
        }

        $result = $room->update($request->except('_token'));

        if ($result) {
            return redirect()->route('room.home')->with('success', 'Room updated successfully!');
        }
    }
}
