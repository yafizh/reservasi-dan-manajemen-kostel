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

    public function employeeService(Request $request)
    {
        $filters = [];
        $employees = Employee::orderBy('name', 'DESC')->get()->map(function ($employee) use ($request, &$filters) {
            $employeeServices = $employee->employeeServices();

            if ($request->get('from') && $request->get('to')) {
                $employeeServices = $employee->employeeServices($request->get('from'), $request->get('to'));
                $from = Carbon::create($request->get('from'))->locale('ID');
                $to = Carbon::create($request->get('to'))->locale('ID');

                $filters['from'] = "{$from->day} {$from->getTranslatedMonthName()} {$from->year}";
                $filters['to'] = "{$to->day} {$to->getTranslatedMonthName()} {$to->year}";
            }

            $employee->serviceCheckIn = $employeeServices['check_ins'];
            $employee->serviceCheckOut = $employeeServices['check_outs'];
            $employee->serviceReservation = $employeeServices['reservations'];
            return $employee;
        });

        return view('dashboard.pages.print.employee-service', compact('employees', 'filters'));
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

        $reservations = $query
            ->get()
            ->map(function ($reservation) {
                $reservationDate = Carbon::create($reservation->reservation_datetime)->locale('ID');
                $checkInDate = Carbon::create($reservation->check_in_date)->locale('ID');
                $reservation->reservation_date = "{$reservationDate->day} {$reservationDate->getTranslatedMonthName()} {$reservationDate->year}";
                $reservation->check_in_date = "{$checkInDate->day} {$checkInDate->getTranslatedMonthName()} {$checkInDate->year}";
                return $reservation;
            });
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

        $checkIns = $query
            ->get()
            ->map(function ($checkIn) {
                $checkInDate = Carbon::create($checkIn->check_in_datetime)->locale('ID');
                $checkIn->check_in_date = "{$checkInDate->day} {$checkInDate->getTranslatedMonthName()} {$checkInDate->year}";
                return $checkIn;
            });
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

        $checkOuts = $query
            ->get()
            ->map(function ($checkOut) {
                $checkOutDate = Carbon::create($checkOut->check_out_datetime)->locale('ID');
                $checkOut->check_out_date = "{$checkOutDate->day} {$checkOutDate->getTranslatedMonthName()} {$checkOutDate->year}";
                return $checkOut;
            });
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

    public function checkInChart(Request $request)
    {
        $filters = [
            "year"      => $request->get('year'),
            "quarter"   => ""
        ];
        $chart = new BarChart;
        $query = CheckIn::whereYear('check_in_datetime', $request->get('year'))->orderBy('check_in_datetime');

        if ($request->get('quarter') == 1) {
            $query->where(function ($q) {
                $q->whereMonth('check_in_datetime', '>=', 1)->whereMonth('check_in_datetime', '<=', 3);
            });
            $chart->labels(['Januari', 'Februari', 'Maret']);
            $filters['quarter'] = "Kuarter 1 (Januari - Maret)";
        }

        if ($request->get('quarter') == 2) {
            $query->where(function ($q) {
                $q->whereMonth('check_in_datetime', '>=', 4)->whereMonth('check_in_datetime', '<=', 6);
            });
            $chart->labels(['April', 'Mei', 'Juni']);
            $filters['quarter'] = "Kuarter 2 (April - Juni)";
        }

        if ($request->get('quarter') == 3) {
            $query->where(function ($q) {
                $q->whereMonth('check_in_datetime', '>=', 7)->whereMonth('check_in_datetime', '<=', 9);
            });
            $chart->labels(['Juli', 'Agustus', 'September']);
            $filters['quarter'] = "Kuarter 3 (Juli - September)";
        }

        if ($request->get('quarter') == 4) {
            $query->where(function ($q) {
                $q->whereMonth('check_in_datetime', '>=', 10)->whereMonth('check_in_datetime', '<=', 12);
            });
            $chart->labels(['Oktober', 'November', 'Desember']);
            $filters['quarter'] = "Kuarter 4 (Oktober - Desember)";
        }

        $dataset = [0, 0, 0];
        foreach ($query->get() as $value) {
            if (in_array(explode('-', $value['check_in_datetime'])[1], [1, 4, 7, 10]))
                $dataset[0]++;

            if (in_array(explode('-', $value['check_in_datetime'])[1], [2, 5, 8, 11]))
                $dataset[1]++;

            if (in_array(explode('-', $value['check_in_datetime'])[1], [3, 6, 9, 12]))
                $dataset[2]++;
        }

        $chart->dataset('Check In', 'bar', $dataset)->options([
            'backgroundColor' => '#204A40',
        ]);
        $chart->setStepSize(max($dataset), 8);

        return view('dashboard.pages.print.check-in-chart', compact('chart', 'filters'));
    }

    public function reservationChart(Request $request)
    {
        $filters = [
            "year"      => $request->get('year'),
            "quarter"   => ""
        ];
        $chart = new BarChart;
        $query = Reservation::whereYear('reservation_datetime', $request->get('year'))->orderBy('reservation_datetime');

        if ($request->get('quarter') == 1) {
            $query->where(function ($q) {
                $q->whereMonth('reservation_datetime', '>=', 1)->whereMonth('reservation_datetime', '<=', 3);
            });
            $chart->labels(['Januari', 'Februari', 'Maret']);
            $filters['quarter'] = "Kuarter 1 (Januari - Maret)";
        }

        if ($request->get('quarter') == 2) {
            $query->where(function ($q) {
                $q->whereMonth('reservation_datetime', '>=', 4)->whereMonth('reservation_datetime', '<=', 6);
            });
            $chart->labels(['April', 'Mei', 'Juni']);
            $filters['quarter'] = "Kuarter 2 (April - Juni)";
        }

        if ($request->get('quarter') == 3) {
            $query->where(function ($q) {
                $q->whereMonth('reservation_datetime', '>=', 7)->whereMonth('reservation_datetime', '<=', 9);
            });
            $chart->labels(['Juli', 'Agustus', 'September']);
            $filters['quarter'] = "Kuarter 3 (Juli - September)";
        }

        if ($request->get('quarter') == 4) {
            $query->where(function ($q) {
                $q->whereMonth('reservation_datetime', '>=', 10)->whereMonth('reservation_datetime', '<=', 12);
            });
            $chart->labels(['Oktober', 'November', 'Desember']);
            $filters['quarter'] = "Kuarter 4 (Oktober - Desember)";
        }

        $dataset = [0, 0, 0];
        foreach ($query->get() as $value) {
            if (in_array(explode('-', $value['reservation_datetime'])[1], [1, 4, 7, 10]))
                $dataset[0]++;

            if (in_array(explode('-', $value['reservation_datetime'])[1], [2, 5, 8, 11]))
                $dataset[1]++;

            if (in_array(explode('-', $value['reservation_datetime'])[1], [3, 6, 9, 12]))
                $dataset[2]++;
        }

        $chart->dataset('Pemesanan', 'bar', $dataset)->options([
            'backgroundColor' => '#204A40',
        ]);
        $chart->setStepSize(max($dataset), 8);

        return view('dashboard.pages.print.reservation-chart', compact('chart', 'filters'));
    }

    public function finance(Request $request)
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

        $finances = $query
            ->get()
            ->map(function ($checkIn) {
                $checkInDate = Carbon::create($checkIn->check_in_datetime)->locale('ID');
                $checkIn->check_in_date = "{$checkInDate->day} {$checkInDate->getTranslatedMonthName()} {$checkInDate->year}";
                return $checkIn;
            });

        $total = 0;
        foreach ($finances as $finance) {
            $total += $finance->price();
        }

        return view('dashboard.pages.print.finance', compact('finances', 'filters', 'total'));
    }
}
