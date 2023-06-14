<?php

namespace App\Http\Controllers;

use App\Charts\BarChart;
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

    public function checkInChart(Request $request)
    {
        $chart = null;
        if ($request->get('quarter') && $request->get('year')) {
            $chart = new BarChart;
            $query = CheckIn::whereYear('check_in_datetime', $request->get('tahun'))->orderBy('check_in_datetime');

            if ($request->get('quarter') == 1) {
                $query->where(function ($q) {
                    $q->whereMonth('check_in_datetime', '>=', 1)->whereMonth('check_in_datetime', '<=', 3);
                });
                $chart->labels(['Januari', 'Februari', 'Maret']);
            }

            if ($request->get('quarter') == 2) {
                $query->where(function ($q) {
                    $q->whereMonth('check_in_datetime', '>=', 4)->whereMonth('check_in_datetime', '<=', 6);
                });
                $chart->labels(['April', 'Mei', 'Juni']);
            }

            if ($request->get('quarter') == 3) {
                $query->where(function ($q) {
                    $q->whereMonth('check_in_datetime', '>=', 7)->whereMonth('check_in_datetime', '<=', 9);
                });
                $chart->labels(['Juli', 'Agustus', 'September']);
            }

            if ($request->get('quarter') == 4) {
                $query->where(function ($q) {
                    $q->whereMonth('check_in_datetime', '>=', 10)->whereMonth('check_in_datetime', '<=', 12);
                });
                $chart->labels(['Oktober', 'November', 'Desember']);
            }

            $dataset = [0, 0, 0];
            foreach ($query->get() as $value) {
                if (in_array(explode('-', $value['tanggal'])[1], [1, 4, 7, 10]))
                    $dataset[0]++;

                if (in_array(explode('-', $value['tanggal'])[1], [2, 5, 8, 11]))
                    $dataset[1]++;

                if (in_array(explode('-', $value['tanggal'])[1], [3, 6, 9, 12]))
                    $dataset[2]++;
            }

            $chart->dataset('Check In', 'bar', $dataset)->options([
                'backgroundColor' => '#204A40',
            ]);
            $chart->setStepSize(max($dataset), 8);
        }
        
        return view('dashboard.pages.report.check-in-chart', compact('chart'));
    }
}
