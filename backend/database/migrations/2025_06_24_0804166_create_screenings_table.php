<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('screenings', function (Blueprint $table) {
            $table->id();
            $table->foreignId("movie_id")->constrained()->onDelete('cascade');
            $table->foreignId('drive_in_cinema_id')->constrained('drive_in_cinemas')->onDelete('cascade');
            $table->dateTime("start_time");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('screenings');
    }
};
