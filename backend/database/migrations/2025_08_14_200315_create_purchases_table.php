<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('screening_id')->constrained('screenings')->cascadeOnDelete();
            $table->foreignId('location_id')->constrained('drive_in_cinemas')->cascadeOnDelete();
            $table->foreignId('movie_id')->constrained('movies')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('ticket_code', 32)->unique();
            $table->string('guest_email', 128)->nullable(); //vendég email cím a jegyhez
            $table->string("parkingspot", 100);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
