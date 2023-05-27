<?php

namespace App\Http\Controllers;

use App\Models\CheckOut;
use Illuminate\Http\Request;

class CheckOutController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.check-out.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(CheckOut $checkOut)
    {
        //
    }

    public function edit(CheckOut $checkOut)
    {
        //
    }

    public function update(Request $request, CheckOut $checkOut)
    {
        //
    }

    public function destroy(CheckOut $checkOut)
    {
        //
    }
}
