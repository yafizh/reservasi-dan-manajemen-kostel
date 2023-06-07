<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomTypePrice extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function reservationType()
    {
        return $this->belongsTo(ReservationType::class);
    }
}
