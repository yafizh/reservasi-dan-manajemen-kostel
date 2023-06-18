<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employeeServices($from = null, $to = null)
    {
        if (!is_null($from) && !is_null($to)) {
            return [
                "check_ins" => $this->whereHas('user', function ($q) use ($from, $to) {
                    $q->whereHas('checkIns', function ($q) use ($from, $to) {
                        $q->whereRaw("DATE(check_in_datetime) >= '{$from}'")->whereRaw("DATE(check_in_datetime) <= '{$to}'");
                    });
                })->count(),
                "check_outs" => $this->whereHas('user', function ($q) use ($from, $to) {
                    $q->whereHas('checkOuts', function ($q) use ($from, $to) {
                        $q->whereRaw("DATE(check_out_datetime) >= '{$from}'")->whereRaw("DATE(check_out_datetime) <= '{$to}'");
                    });
                })->count(),
                "reservations" => $this->whereHas('user', function ($q) use ($from, $to) {
                    $q->whereHas('reservations', function ($q) use ($from, $to) {
                        $q->whereRaw("DATE(reservation_datetime) >= '{$from}'")->whereRaw("DATE(reservation_datetime) <= '{$to}'");
                    });
                })->count(),
            ];
        }

        return [
            "check_ins" => $this->user->checkIns->count(),
            "check_outs" => $this->user->checkOuts->count(),
            "reservations" => $this->user->reservations->count(),
        ];
    }
}
