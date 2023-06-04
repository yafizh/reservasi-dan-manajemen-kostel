<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function images()
    {
        return $this->hasMany(RoomTypeImage::class);
    }

    public function prices()
    {
        return $this->hasMany(RoomTypePrice::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function availableRooms()
    {
        return $this->hasMany(Room::class)->where('status', 1);
    }
}
