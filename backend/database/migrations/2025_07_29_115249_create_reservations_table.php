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
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string("confirmation", 25); // elv. generálásban 24 karaktert használ, de biztosra megyek.
            $table->foreignId("location_id")->constrained("drive_in_cinemas", "id");
            $table->foreignId("screening_id")->constrained("screenings", "id");
            $table->string("parkingspot", 100);
            $table->dateTime("reserved_at");
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
