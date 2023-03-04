<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('weather_forecasts', function (Blueprint $table) {
            $table->id();
            $table->decimal('temperature', 10);
            $table->decimal('pressure', 10);
            $table->decimal('humidity', 10);
            $table->decimal('clouds', 10);
            $table->decimal('wind_speed', 10);
            $table->string('condition_name');
            $table->string('description');

            $table->foreignId('user_id')->constrained('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weather_forecasts');
    }
};
