<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckOut extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function checkIn() {
        return $this->belongsTo(CheckIn::class);
    }
}
