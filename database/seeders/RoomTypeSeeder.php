<?php

namespace Database\Seeders;

use App\Models\RoomType;
use App\Models\RoomTypePrice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    public function run(): void
    {
        RoomType::create([
            'name'      => 'VIP',
            'facilities' => '',
            'order'     => 1
        ]);
        RoomTypePrice::create([
            'room_type_id' => 1,
            'reservation_type_id' => 1,
            'price' => 1,
        ]);
        RoomTypePrice::create([
            'room_type_id' => 1,
            'reservation_type_id' => 2,
            'price' => 2,
        ]);
        RoomTypePrice::create([
            'room_type_id' => 1,
            'reservation_type_id' => 3,
            'price' => 3,
        ]);
        RoomTypePrice::create([
            'room_type_id' => 1,
            'reservation_type_id' => 4,
            'price' => 4,
        ]);

        RoomType::create([
            'name'      => 'STANDARD',
            'facilities' => '',
            'order'     => 2
        ]);
        RoomTypePrice::create([
            'room_type_id' => 2,
            'reservation_type_id' => 1,
            'price' => 1,
        ]);
        RoomTypePrice::create([
            'room_type_id' => 2,
            'reservation_type_id' => 2,
            'price' => 2,
        ]);
        RoomTypePrice::create([
            'room_type_id' => 2,
            'reservation_type_id' => 3,
            'price' => 3,
        ]);
        RoomTypePrice::create([
            'room_type_id' => 2,
            'reservation_type_id' => 4,
            'price' => 4,
        ]);
    }
}
