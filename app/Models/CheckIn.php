<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckIn extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function reservationType()
    {
        return $this->belongsTo(ReservationType::class);
    }

    function price() {
        return RoomTypePrice::where('room_type_id', $this->room->roomType->id)->where('reservation_type_id', $this->reservationType->id)->first()->price;
    }

}
