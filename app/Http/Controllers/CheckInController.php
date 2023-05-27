<?php

namespace App\Http\Controllers;

use App\Models\CheckIn;
use Illuminate\Http\Request;

class CheckInController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.check-in.index');
    }

    public function create()
    {
        // 
    }

    public function store(Request $request)
    {
        //
    }

    public function show(CheckIn $checkIn)
    {
        //
    }

    public function edit(CheckIn $checkIn)
    {
        //
    }

    public function update(Request $request, CheckIn $checkIn)
    {
        //
    }

    public function destroy(CheckIn $checkIn)
    {
        //
    }
}
