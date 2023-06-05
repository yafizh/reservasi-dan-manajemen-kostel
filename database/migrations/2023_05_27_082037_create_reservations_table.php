<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('room_id');
            $table->string('id_number', 20);
            $table->string('name');
            $table->string('phone_number', 20);
            $table->unsignedBigInteger('down_payment');
            $table->timestamp('reservation_datetime');
            $table->date('check_in_date');
            $table->unsignedTinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
