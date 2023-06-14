<?php

namespace App\Http\Controllers;

use App\Models\CheckIn;
use App\Models\CheckOut;
use App\Models\Employee;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function employee(Request $request)
    {
        $employees = Employee::orderBy('name')->get();
        return view('dashboard.pages.report.employee', compact('employees'));
    }

    public function reservation(Request $request)
    {
        $query = Reservation::orderBy('created_at', 'DESC');

        if ($request->get('from') && $request->get('to')) {
            $query->whereRaw('DATE(reservation_datetime) = ' . $request->get('from'))
                ->whereRaw('DATE(reservation_datetime) = ' . $request->get('to'));
        }

        $reservations = $query->get();
        return view('dashboard.pages.report.reservation', compact('reservations'));
    }

    public function checkIn(Request $request)
    {
        $query = CheckIn::orderBy('created_at', 'DESC');

        if ($request->get('from') && $request->get('to')) {
            $query->whereRaw('DATE(check_in_datetime) = ' . $request->get('from'))
                ->whereRaw('DATE(check_in_datetime) = ' . $request->get('to'));
        }

        $checkIns = $query->get();
        return view('dashboard.pages.report.check-in', compact('checkIns'));
    }

    public function checkOut(Request $request)
    {
        $query = CheckOut::orderBy('created_at', 'DESC');

        if ($request->get('from') && $request->get('to')) {
            $query->whereRaw('DATE(check_out_datetime) = ' . $request->get('from'))
                ->whereRaw('DATE(check_out_datetime) = ' . $request->get('to'));
        }

        $checkOuts = $query->get();
        return view('dashboard.pages.report.check-out', compact('checkOuts'));
    }

    public function availableRoom(Request $request)
    {
        $query = Room::orderBy('number');

        if ($request->get('status') && $request->get('date')) {
            if ($request->get('status') == 1) {
                $query->whereDoesntHave('checkIns', function ($q) use ($request) {
                    $q->whereRaw("DATE(check_in_datetime) != '{$request->get('date')}'");
                })->whereDoesntHave('reservations', function ($q) use ($request) {
                    $q->whereRaw("DATE(reservation_datetime) != '{$request->get('date')}'");
                });
            }

            if ($request->get('status') == 2) {
                $query->whereHas('reservations', function ($q) use ($request) {
                    $q->whereRaw("DATE(reservation_datetime) = '{$request->get('date')}'");
                });
            }

            if ($request->get('status') == 3) {
                $query->whereHas('checkIns', function ($q) use ($request) {
                    $q->whereRaw("DATE(check_in_datetime) = '{$request->get('date')}'");
                });
            }
        }

        $rooms = $query->get();
        return view('dashboard.pages.report.available-room', compact('rooms'));
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
