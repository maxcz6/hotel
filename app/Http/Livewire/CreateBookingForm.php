<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreateBookingForm extends Component
{
    public function render()
    {
        return view('livewire.create-booking-form');
    }
}

/**
 * CreateBookingForm
 *
 * Livewire multi-step form stub for creating bookings: seleccionar fechas,
 * elegir habitación disponible, ingresar datos del huésped y confirmar.
 */
