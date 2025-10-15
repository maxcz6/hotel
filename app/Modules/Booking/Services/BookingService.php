<?php

namespace App\Modules\Booking\Services;

use App\Modules\Booking\Models\Booking;
use App\Modules\Booking\Models\Guest;
use App\Modules\RoomManagement\Models\Room;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use InvalidArgumentException;

class BookingService
{
    public function createBooking(array $data): Booking
    {
        // Basic validation of dates
        if (empty($data['check_in_date']) || empty($data['check_out_date'])) {
            throw new InvalidArgumentException('check_in_date and check_out_date are required');
        }

        $room = Room::findOrFail($data['room_id']);

        // Check availability: no overlapping bookings for same room
        $overlap = Booking::where('room_id', $room->id)
            ->where(function ($q) use ($data) {
                $q->whereBetween('check_in_date', [$data['check_in_date'], $data['check_out_date']])
                  ->orWhereBetween('check_out_date', [$data['check_in_date'], $data['check_out_date']])
                  ->orWhere(function ($q2) use ($data) {
                      $q2->where('check_in_date', '<=', $data['check_in_date'])
                         ->where('check_out_date', '>=', $data['check_out_date']);
                  });
            })->exists();

        if ($overlap) {
            throw new InvalidArgumentException('Room is not available for the selected dates');
        }

        return DB::transaction(function () use ($data, $room) {
            $guest = Guest::firstOrCreate(
                ['email' => $data['email'] ?? null],
                [
                    'full_name' => $data['full_name'] ?? ($data['name'] ?? 'Guest'),
                    'phone' => $data['phone'] ?? null,
                    'document_type' => $data['document_type'] ?? null,
                    'document_number' => $data['document_number'] ?? null,
                ]
            );

            $nights = (new \DateTime($data['check_out_date']))->diff(new \DateTime($data['check_in_date']))->days;
            $total = $nights * ($room->type->base_price ?? 0);

            $booking = Booking::create([
                'guest_id' => $guest->id,
                'room_id' => $room->id,
                'check_in_date' => $data['check_in_date'],
                'check_out_date' => $data['check_out_date'],
                'total_price' => $total,
                'status' => $data['status'] ?? 'pending',
            ]);

            // Update room status if booking is confirmed
            if (($data['status'] ?? 'pending') === 'confirmed') {
                $room->status = 'occupied';
                $room->save();
            }

            Event::dispatch(new \App\Modules\Booking\Events\BookingCreated($booking));

            return $booking;
        });
    }
}

/**
 * BookingService
 *
 * Servicio con responsabilidad para crear reservas (bookings). Su método
 * createBooking realiza las siguientes tareas:
 *  - Valida la disponibilidad de la habitación para las fechas solicitadas
 *  - Crea o encuentra al huésped (Guest)
 *  - Crea el booking y calcula el total
 *  - Actualiza el estado de la habitación si corresponde
 *  - Dispara el evento BookingCreated
 *
 * Usar este servicio desde controladores o Livewire components para centralizar
 * la lógica de negocio y mantener el código testeable.
 */
