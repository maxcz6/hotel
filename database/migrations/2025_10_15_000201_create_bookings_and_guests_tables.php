<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->enum('document_type', ['dni', 'passport'])->nullable();
            $table->string('document_number')->nullable();
            $table->timestamps();
        });

        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guest_id')->constrained('guests')->cascadeOnDelete();
            $table->foreignId('room_id')->constrained('rooms')->cascadeOnDelete();
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->decimal('total_price', 10, 2)->default(0);
            $table->enum('status', ['pending', 'confirmed', 'check_in', 'check_out', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('guests');
    }
};

/**
 * Migración: create_bookings_and_guests_tables
 *
 * Crea las tablas `guests` y `bookings` usadas por el módulo Booking. `bookings`
 * contiene la información central de reservas y un campo `status` para el flujo
 * de la reserva.
 */
