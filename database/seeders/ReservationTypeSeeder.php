<?php

namespace Database\Seeders;

use App\Models\ReservationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationTypeSeeder extends Seeder
{
    public function run(): void
    {
        // 1 is Monly
        ReservationType::create([
            'name' => 1,
            'order' => 1
        ]);

        // 2 is Weekly
        ReservationType::create([
            'name' => 2,
            'order' => 2
        ]);

        // 3 is Daily in Weekday
        ReservationType::create([
            'name' => 3,
            'order' => 3
        ]);

        // 4 is Daily in Weekend
        ReservationType::create([
            'name' => 4,
            'order' => 4
        ]);
    }
}
