<?php

namespace App\Http\Controllers;

use App\Charts\BarChart;
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

    public function availableRoom(Request $request)
    {
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

    public function checkInChart()
    {
        $filters = [
            "year"      => request()->get('year'),
            "quarter"   => ""
        ];
        $chart = new BarChart;
        $query = CheckIn::whereYear('check_in_datetime', request()->get('year'))->orderBy('check_in_datetime');

        if (request()->get('quarter') == 1) {
            $query->where(function ($q) {
                $q->whereMonth('check_in_datetime', '>=', 1)->whereMonth('check_in_datetime', '<=', 3);
            });
            $chart->labels(['Januari', 'Februari', 'Maret']);
            $filters['quarter'] = "Kuarter 1 (Januari - Maret)";
        }

        if (request()->get('quarter') == 2) {
            $query->where(function ($q) {
                $q->whereMonth('check_in_datetime', '>=', 4)->whereMonth('check_in_datetime', '<=', 6);
            });
            $chart->labels(['April', 'Mei', 'Juni']);
            $filters['quarter'] = "Kuarter 2 (April - Juni)";
        }

        if (request()->get('quarter') == 3) {
            $query->where(function ($q) {
                $q->whereMonth('check_in_datetime', '>=', 7)->whereMonth('check_in_datetime', '<=', 9);
            });
            $chart->labels(['Juli', 'Agustus', 'September']);
            $filters['quarter'] = "Kuarter 3 (Juli - September)";
        }

        if (request()->get('quarter') == 4) {
            $query->where(function ($q) {
                $q->whereMonth('check_in_datetime', '>=', 10)->whereMonth('check_in_datetime', '<=', 12);
            });
            $chart->labels(['Oktober', 'November', 'Desember']);
            $filters['quarter'] = "Kuarter 4 (Oktober - Desember)";
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

        return view('dashboard.pages.print.check-in-chart', compact('chart', 'filters'));
    }
}
