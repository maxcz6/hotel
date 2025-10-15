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
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('base_price', 10, 2)->default(0);
            $table->integer('capacity')->default(2);
            $table->timestamps();
        });

        Schema::table('rooms', function (Blueprint $table) {
            if (!Schema::hasColumn('rooms', 'room_type_id')) {
                $table->foreignId('room_type_id')->nullable()->constrained('room_types')->nullOnDelete();
            }
            if (!Schema::hasColumn('rooms', 'room_number')) {
                $table->string('room_number')->nullable();
            }
            if (!Schema::hasColumn('rooms', 'status')) {
                $table->string('status')->default('available');
            }
        });
    }

    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            if (Schema::hasColumn('rooms', 'room_type_id')) {
                $table->dropConstrainedForeignId('room_type_id');
            }
            if (Schema::hasColumn('rooms', 'room_number')) {
                $table->dropColumn('room_number');
            }
            if (Schema::hasColumn('rooms', 'status')) {
                $table->dropColumn('status');
            }
        });

        Schema::dropIfExists('room_types');
    }
};

/**
 * Migración: create_room_types_table
 *
 * Crea la tabla `room_types` y agrega columnas auxiliares a `rooms` (room_type_id,
 * room_number, status) si no existen. Mantener migraciones idempotentes.
 */
