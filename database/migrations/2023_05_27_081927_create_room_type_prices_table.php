<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('room_type_prices', function (Blueprint $table) {
            $table->foreignId('room_type_id');
            $table->foreignId('reservation_type_id');
            $table->index(['room_type_id', 'reservation_type_id']);
            $table->unique('room_type_id', 'reservation_type_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('room_type_prices');
    }
};
