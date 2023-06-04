<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        Room::create([
            'room_type_id'  => 1,
            'number'        => 1,
            'floor'         => 2,
        ]);

        Room::create([
            'room_type_id'  => 1,
            'number'        => 2,
            'floor'         => 2,
        ]);

        Room::create([
            'room_type_id'  => 1,
            'number'        => 3,
            'floor'         => 2,
        ]);

        Room::create([
            'room_type_id'  => 2,
            'number'        => 4,
            'floor'         => 1,
        ]);

        Room::create([
            'room_type_id'  => 2,
            'number'        => 5,
            'floor'         => 1,
        ]);

        Room::create([
            'room_type_id'  => 2,
            'number'        => 6,
            'floor'         => 1,
        ]);
    }
}
