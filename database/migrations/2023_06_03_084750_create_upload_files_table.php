<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('upload_files', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('filename_original');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('upload_files');
    }
};
