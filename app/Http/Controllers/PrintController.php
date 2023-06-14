<?php

namespace App\Http\Controllers;

use App\Models\CheckIn;
use App\Models\CheckOut;
use App\Models\Employee;
use App\Models\Reservation;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function employee(Request $request)
    {
        $employees = Employee::orderBy('name')->get();
        return view('dashboard.pages.print.employee', compact('employees'));
    }

    public function reservation(Request $request)
    {
        $filters = [];
        $query = Reservation::orderBy('created_at', 'DESC');

        if ($request->get('from') && $request->get('to')) {
            $query->whereRaw('DATE(reservation_datetime) = ' . $request->get('from'))
                ->whereRaw('DATE(reservation_datetime) = ' . $request->get('to'));

            $from = Carbon::create($request->get('from'))->locale('ID');
            $to = Carbon::create($request->get('to'))->locale('ID');

            $filters['from'] = "{$from->day} {$from->getTranslatedMonthName()} {$from->year}";
            $filters['to'] = "{$to->day} {$to->getTranslatedMonthName()} {$to->year}";
        }

        $reservations = $query->get();
        return view('dashboard.pages.print.reservation', compact('reservations', 'filters'));
    }

    public function checkIn(Request $request)
    {
        $filters = [];
        $query = CheckIn::orderBy('created_at', 'DESC');

        if ($request->get('from') && $request->get('to')) {
            $query->whereRaw('DATE(check_in_datetime) = ' . $request->get('from'))
                ->whereRaw('DATE(check_in_datetime) = ' . $request->get('to'));

            $from = Carbon::create($request->get('from'))->locale('ID');
            $to = Carbon::create($request->get('to'))->locale('ID');

            $filters['from'] = "{$from->day} {$from->getTranslatedMonthName()} {$from->year}";
            $filters['to'] = "{$to->day} {$to->getTranslatedMonthName()} {$to->year}";
        }

        $checkIns = $query->get();
        return view('dashboard.pages.print.check-in', compact('checkIns', 'filters'));
    }

    public function checkOut(Request $request)
    {
        $filters = [];
        $query = CheckOut::orderBy('created_at', 'DESC');

        if ($request->get('from') && $request->get('to')) {
            $query->whereRaw('DATE(check_out_datetime) = ' . $request->get('from'))
                ->whereRaw('DATE(check_out_datetime) = ' . $request->get('to'));

            $from = Carbon::create($request->get('from'))->locale('ID');
            $to = Carbon::create($request->get('to'))->locale('ID');

            $filters['from'] = "{$from->day} {$from->getTranslatedMonthName()} {$from->year}";
            $filters['to'] = "{$to->day} {$to->getTranslatedMonthName()} {$to->year}";
        }

        $checkOuts = $query->get();
        return view('dashboard.pages.print.check-out', compact('checkOuts', 'filters'));
    }

    public function availableRoom(Request $request) {
        $filters = [];
        $query = Room::orderBy('number');

        if ($request->get('status') && $request->get('date')) {
            $date = Carbon::create($request->get('date'))->locale('ID');
            $filters['date'] = "{$date->day} {$date->getTranslatedMonthName()} {$date->year}";

            if ($request->get('status') == 1) {
                $query->whereDoesntHave('checkIns', function ($q) use ($request) {
                    $q->whereRaw("DATE(check_in_datetime) != '{$request->get('date')}'");
                })->whereDoesntHave('reservations', function ($q) use ($request) {
                    $q->whereRaw("DATE(reservation_datetime) != '{$request->get('date')}'");
                });
                $filters['status'] = "Tersedia";
            }

            if ($request->get('status') == 2) {
                $query->whereHas('reservations', function ($q) use ($request) {
                    $q->whereRaw("DATE(reservation_datetime) = '{$request->get('date')}'");
                });
                $filters['status'] = "Dipesan";
            }

            if ($request->get('status') == 3) {
                $query->whereHas('checkIns', function ($q) use ($request) {
                    $q->whereRaw("DATE(check_in_datetime) = '{$request->get('date')}'");
                });
                $filters['status'] = "Tidak Tersedia";
            }
        }

        $rooms = $query->get();
        return view('dashboard.pages.print.available-room', compact('rooms', 'filters'));
    }
}
