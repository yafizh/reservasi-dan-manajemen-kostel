<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function checkIn()
    {
        return $this->hasOneThrough(CheckIn::class, ReservationCheckIn::class, null, 'id', null, 'check_in_id');
    }
}
