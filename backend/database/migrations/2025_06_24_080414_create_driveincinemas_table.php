<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('drive_in_cinemas', function (Blueprint $table) {
            $table->id();
            $table->string("name", 100)->required(); 
            $table->string("location", 100)->required();
            $table->text("description")->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('drive_in_cinemas');
    }
};
