<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function roomType() {
        return $this->belongsTo(RoomType::class);
    }

    function checkIns() {
        return $this->hasMany(CheckIn::class);
    }

    function reservations() {
        return $this->hasMany(Reservation::class);
    }
}
