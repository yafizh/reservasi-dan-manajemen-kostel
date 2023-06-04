<?php

namespace Database\Seeders;

use App\Models\RoomType;
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
        RoomType::create([
            'name'      => 'STANDARD',
            'facilities' => '',
            'order'     => 2
        ]);
    }
}
