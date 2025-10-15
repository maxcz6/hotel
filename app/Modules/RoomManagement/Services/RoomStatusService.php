<?php

namespace App\Modules\RoomManagement\Services;

use App\Modules\RoomManagement\Models\Room;
use InvalidArgumentException;

class RoomStatusService
{
    protected array $allowedTransitions = [
        'available' => ['cleaning', 'occupied', 'maintenance'],
        'cleaning' => ['available'],
        'occupied' => ['cleaning', 'maintenance'],
        'maintenance' => ['available'],
    ];

    public function changeStatus(Room $room, string $to): Room
    {
        // Estado actual de la habitación
        $from = $room->status;
        // Normalizamos el estado destino a minúsculas
        $to = strtolower($to);

        // Validamos que el estado actual esté en nuestro mapa de transiciones
        if (!isset($this->allowedTransitions[$from])) {
            throw new InvalidArgumentException("Unknown from status: {$from}");
        }

        // Verificamos si la transición está permitida
        if (!in_array($to, $this->allowedTransitions[$from], true)) {
            // Lanzar excepción para que el caller pueda manejar el error (ej. mostrar mensaje)
            throw new InvalidArgumentException("Invalid transition from {$from} to {$to}");
        }

        // Aplicar el cambio y persistir
        $room->status = $to;
        $room->save();

        // Retornamos la entidad actualizada
        return $room;
    }
}

/**
 * RoomStatusService
 *
 * Servicio que encapsula la lógica de transición de estados de una habitación.
 * Define transiciones permitidas y evita cambios inconsistentes (por ejemplo
 * maintenance -> occupied sin pasar por available).
 *
 * Uso recomendado:
 * - Inyectar este servicio en controladores o Livewire components y llamar
 *   a changeStatus($room, $newStatus) para validar y aplicar cambios.
 */
