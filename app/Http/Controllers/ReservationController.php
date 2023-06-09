<?php

namespace App\Http\Controllers;

use App\Models\CheckIn;
use App\Models\Reservation;
use App\Models\ReservationCheckIn;
use App\Models\RoomType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::orderBy('reservation_datetime', 'DESC')
            ->where('status', 1)
            ->get()
            ->map(function ($reservation) {
                $reservationDate = Carbon::create($reservation->reservation_datetime)->locale('ID');
                $checkInDate = Carbon::create($reservation->check_in_date)->locale('ID');
                $reservation->reservation_date = "{$reservationDate->day} {$reservationDate->getTranslatedMonthName()} {$reservationDate->year}";
                $reservation->check_in_date = "{$checkInDate->day} {$checkInDate->getTranslatedMonthName()} {$checkInDate->year}";
                return $reservation;
            });
        return view('dashboard.pages.reservation.index', compact('reservations'));
    }

    public function create()
    {
        $roomTypes = RoomType::orderBy('order')->get();
        return view('dashboard.pages.reservation.create', compact('roomTypes'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_number'     => 'required',
            'name'          => 'required',
            'phone_number'  => 'required',
            'room_id'       => 'required',
            'check_in_date' => 'required',
            'down_payment'  => 'required',
        ]);

        $validatedData['down_payment'] = implode('', explode('.', $validatedData['down_payment']));
        $validatedData['user_id'] = Auth::user()->id ?? null;
        $validatedData['reservation_datetime'] = Carbon::now()->setTimezone('Asia/Kuala_Lumpur')->toDateTimeLocalString();
        Reservation::create($validatedData);

        return redirect('/reservations')->with('success', 'Berhasil menambah data pemesanan!');
    }

    public function show(Reservation $reservation)
    {
        $reservationDate = Carbon::create($reservation->reservation_datetime)->locale('ID');
        $checkInDate = Carbon::create($reservation->check_in_date)->locale('ID');
        $reservation->reservation_date = "{$reservationDate->day} {$reservationDate->getTranslatedMonthName()} {$reservationDate->year}";
        $reservation->check_in_date = "{$checkInDate->day} {$checkInDate->getTranslatedMonthName()} {$checkInDate->year}";
        return view('dashboard.pages.reservation.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        $roomTypes = RoomType::orderBy('order')->get();
        return view('dashboard.pages.reservation.edit', compact('roomTypes', 'reservation'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $validatedData = $request->validate([
            'id_number'     => 'required',
            'name'          => 'required',
            'phone_number'  => 'required',
            'room_id'       => 'required',
            'check_in_date' => 'required',
            'down_payment'  => 'required',
        ]);

        $validatedData['down_payment'] = implode('', explode('.', $validatedData['down_payment']));
        Reservation::where('id', $reservation->id)->update($validatedData);

        return redirect('/reservations')->with('success', 'Berhasil memperbaharui data pemesanan!');
    }

    public function destroy(Reservation $reservation)
    {
        if ($reservation->checkIn) {
            CheckIn::destroy($reservation->checkIn->id);
            ReservationCheckIn::where('reservation_id', $reservation->id)
                ->where('check_in_id', $reservation->checkIn->id)
                ->delete();
        }
        Reservation::destroy($reservation->id);

        return redirect('/reservations')->with('success', 'Berhasil menghapus data pemesanan!');
    }

    public function cancelReservation(Reservation $reservation)
    {
        Reservation::where('id', $reservation->id)->update(['status' => 3]);

        return redirect('/reservations')->with('success', 'Berhasil memperbaharui status data pemesanan!');
    }

    public function missingClient(Reservation $reservation)
    {
        Reservation::where('id', $reservation->id)->update(['status' => 4]);

        return redirect('/reservations')->with('success', 'Berhasil memperbaharui status data pemesanan!');
    }
}
