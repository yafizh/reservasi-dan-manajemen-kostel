<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(RoomType $roomType)
    {
        $rooms = Room::where('room_type_id', $roomType->id)->get();
        return view('dashboard.pages.room-type.room.index', compact('rooms', 'roomType'));
    }

    public function create(RoomType $roomType)
    {
        return view('dashboard.pages.room-type.room.create', compact('roomType'));
    }

    public function store(Request $request, RoomType $roomType)
    {
        $validatedData = $request->validate([
            'number'    => 'required',
            'floor'     => 'required',
        ]);

        Room::create([
            'room_type_id'  => $roomType->id,
            'number'        => $validatedData['number'],
            'floor'         => $validatedData['floor'],
        ]);

        return redirect('/room-types/' . $roomType->id . '/rooms')->with('success', 'Berhasil menambah data kamar!');
    }

    public function show(Room $room)
    {
        //
    }

    public function edit(RoomType $roomType, Room $room)
    {
        return view('dashboard.pages.room-type.room.edit', compact('roomType', 'room'));
    }

    public function update(Request $request, RoomType $roomType, Room $room)
    {
        $validatedData = $request->validate([
            'number'    => 'required',
            'floor'     => 'required',
        ]);

        Room::where('id', $room->id)->update([
            'number'        => $validatedData['number'],
            'floor'         => $validatedData['floor'],
        ]);

        return redirect('/room-types/' . $roomType->id . '/rooms')->with('success', 'Berhasil memperbaharui data kamar!');
    }

    public function destroy(RoomType $roomType, Room $room)
    {
        Room::destroy($room->id);

        return redirect('/room-types/' . $roomType->id . '/rooms')->with('success', 'Berhasil menghapus data kamar!');
    }
}
