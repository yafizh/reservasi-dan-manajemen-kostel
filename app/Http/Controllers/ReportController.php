<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function reservation()
    {
        return view('dashboard.pages.report.reservation');
    }

    public function checkIn()
    {
        return view('dashboard.pages.report.check-in');
    }

    public function checkOut()
    {
        return view('dashboard.pages.report.check-out');
    }

    public function availableRoom()
    {
        return view('dashboard.pages.report.available-room');
    }

    public function reservationChart()
    {
        return view('dashboard.pages.report.reservation-chart');
    }

    public function checkInChart()
    {
        return view('dashboard.pages.report.check-in-chart');
    }
}
