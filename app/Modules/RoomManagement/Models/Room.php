<?php

namespace App\Modules\RoomManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';

    protected $fillable = ['room_type_id', 'room_number', 'status'];

    public function type()
    {
        // Relación Eloquent con RoomType. Permite acceder a los atributos del tipo
        // de habitación (precio base, capacidad, etc.) desde una instancia Room.
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }
}

/**
 * Room
 *
 * Representa una habitación física en el hotel. Está relacionada con un RoomType
 * que define atributos comunes. Campos:
 * - room_type_id: FK a room_types
 * - room_number: identificador visible (ej. "101")
 * - status: estado actual (available, occupied, cleaning, maintenance)
 *
 * Nota: este modelo vive bajo el namespace del módulo RoomManagement para
 * mantener el código organizado por funcionalidad.
 */
