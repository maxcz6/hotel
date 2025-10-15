<?php

namespace App\Modules\Booking\Events;

use App\Modules\Booking\Models\Booking;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BookingCreated
{
    use Dispatchable, SerializesModels;

    public Booking $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }
}

/**
 * BookingCreated
 *
 * Evento disparado cuando se crea una reserva. Los listeners pueden usarlo para
 * enviar confirmaciones por email, generar facturas, o notificar a sistemas
 * externos.
 */
