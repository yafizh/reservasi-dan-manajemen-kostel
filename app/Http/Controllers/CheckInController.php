<?php

namespace App\Http\Controllers;

use App\Models\CheckIn;
use App\Models\Reservation;
use App\Models\ReservationCheckIn;
use App\Models\ReservationType;
use App\Models\RoomType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckInController extends Controller
{
    public function index()
    {
        $checkIns = CheckIn::orderBy('check_in_datetime', 'DESC')
            ->get()
            ->map(function ($checkIn) {
                $checkInDate = Carbon::create($checkIn->check_in_datetime)->locale('ID');
                $checkIn->check_in_date = "{$checkInDate->day} {$checkInDate->getTranslatedMonthName()} {$checkInDate->year}";
                return $checkIn;
            });
        return view('dashboard.pages.check-in.index', compact('checkIns'));
    }

    public function create()
    {
        $reservation = null;
        if (request()->get('reservation_id'))
            $reservation = Reservation::find(request()->get('reservation_id'));

        $roomTypes = RoomType::orderBy('order')->get();
        $reservationTypes = ReservationType::orderBy('order')->get();
        return view('dashboard.pages.check-in.create', compact(
            'reservation',
            'roomTypes',
            'reservationTypes',
        ));
    }

    public function store(Request $request)
    {
        if (is_null($request->get('reservation_id'))) {
            $validatedData = $request->validate([
                'id_number' => 'required',
                'name' => 'required',
                'phone_number' => 'required',
                'room_id' => 'required',
                'reservation_type_id' => 'required',
            ]);
        } else {
            $validatedData = $request->validate([
                'reservation_type_id' => 'required',
            ]);

            $reservation = Reservation::find($request->get('reservation_id'));
            $validatedData['id_number']     = $reservation->id_number;
            $validatedData['name']          = $reservation->name;
            $validatedData['phone_number']  = $reservation->phone_number;
            $validatedData['room_id']       = $reservation->room_id;
        }

        $validatedData['user_id']           = Auth::user()->id ?? null;
        $validatedData['check_in_datetime'] = Carbon::now()->setTimezone('Asia/Kuala_Lumpur')->toDateTimeLocalString();
        $checkInId = CheckIn::create($validatedData)->id;

        if (!is_null($request->get('reservation_id'))) {
            Reservation::find($request->get('reservation_id'))->update(['status' => 2]);
            ReservationCheckIn::create([
                'reservation_id' => $request->get('reservation_id'),
                'check_in_id'   => $checkInId
            ]);
        }

        return redirect('/check-ins')->with('success', 'Berhasil menambah data check in!');
    }

    public function show(CheckIn $checkIn)
    {
        $checkInDate = Carbon::create($checkIn->check_in_datetime)->locale('ID');
        $checkIn->check_in_date = "{$checkInDate->day} {$checkInDate->getTranslatedMonthName()} {$checkInDate->year}";
        return view('dashboard.pages.check-in.show', compact('checkIn'));
    }

    public function edit(CheckIn $checkIn)
    {
        $roomTypes = RoomType::orderBy('order')->get();
        $reservationTypes = ReservationType::orderBy('order')->get();
        return view('dashboard.pages.check-in.edit', compact(
            'checkIn',
            'roomTypes',
            'reservationTypes',
        ));
    }

    public function update(Request $request, CheckIn $checkIn)
    {
        $validatedData = $request->validate([
            'id_number'             => 'required',
            'name'                  => 'required',
            'phone_number'          => 'required',
            'room_id'               => 'required',
            'reservation_type_id'   => 'required',
        ]);
        $checkIn->update($validatedData);

        return redirect('/check-ins')->with('success', 'Berhasil memperbaharui data check in!');
    }

    public function destroy(CheckIn $checkIn)
    {
        ReservationCheckIn::where('check_in_id', $checkIn->id)->delete();
        CheckIn::destroy($checkIn->id);

        return redirect('/check-ins')->with('success', 'Berhasil menghapus data check in!');
    }
}
