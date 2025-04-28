<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sensors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sensor_id')->unique(); // Unique device ID
            $table->decimal('latitude', 10, 8);    // e.g. 6.9270796 (Colombo)
            $table->decimal('longitude', 11, 8);   // e.g. 79.8612430
            $table->boolean('is_active')->default(true);
            $table->text('location_description')->nullable();
            $table->foreignId('installed_by')->constrained('users');
            $table->timestamps();
            $table->softDeletes(); // For archiving sensors
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensors');
    }
}; 