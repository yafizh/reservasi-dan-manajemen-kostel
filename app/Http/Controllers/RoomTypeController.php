<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.room-type.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(RoomType $roomType)
    {
        //
    }

    public function edit(RoomType $roomType)
    {
        //
    }

    public function update(Request $request, RoomType $roomType)
    {
        //
    }

    public function destroy(RoomType $roomType)
    {
        //
    }
}
