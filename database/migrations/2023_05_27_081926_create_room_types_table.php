<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20);
            $table->unsignedTinyInteger('order');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('room_types');
    }
};
