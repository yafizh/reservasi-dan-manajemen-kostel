<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservation_check_ins', function (Blueprint $table) {
            $table->foreignId('reservation_id');
            $table->foreignId('check_in_id');
            $table->index(['reservation_id', 'check_in_id']);
            $table->unique('reservation_id', 'check_in_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservation_check_ins');
    }
};
