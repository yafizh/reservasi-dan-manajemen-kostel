<?php

namespace App\Http\Controllers;

use App\Models\CheckIn;
use App\Models\CheckOut;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CheckOutController extends Controller
{
    public function index()
    {
        $checkOuts = CheckOut::orderBy('created_at', 'DESC')
            ->get()
            ->map(function ($checkOut) {
                $checkOutDate = Carbon::create($checkOut->check_out_datetime)->locale('ID');
                $checkOut->check_out_date = "{$checkOutDate->day} {$checkOutDate->getTranslatedMonthName()} {$checkOutDate->year}";
                return $checkOut;
            });
        return view('dashboard.pages.check-out.index', compact('checkOuts'));
    }

    public function store(CheckIn $checkIn)
    {
        CheckOut::create([
            'check_in_id' => $checkIn->id,
            'user_id' => Auth::user()->id ?? null,
            'check_out_datetime' => Carbon::now()->setTimezone('Asia/Kuala_Lumpur')->toDateTimeLocalString(),
        ]);

        return redirect('/check-outs')->with('success', 'Berhasil menambah data check out!');
    }

    public function show(CheckOut $checkOut)
    {
        $checkInDate = Carbon::create($checkOut->check_in_datetime)->locale('ID');
        $checkOutDate = Carbon::create($checkOut->check_out_datetime)->locale('ID');
        $checkOut->checkIn->check_in_date = "{$checkInDate->day} {$checkInDate->getTranslatedMonthName()} {$checkInDate->year}";
        $checkOut->check_out_date = "{$checkOutDate->day} {$checkOutDate->getTranslatedMonthName()} {$checkOutDate->year}";
        return view('dashboard.pages.check-out.show', compact('checkOut'));
    }

    public function destroy(CheckOut $checkOut)
    {
        CheckOut::destroy($checkOut->id);

        return redirect('/check-outs')->with('success', 'Berhasil menghapus data check out!');
    }
}
