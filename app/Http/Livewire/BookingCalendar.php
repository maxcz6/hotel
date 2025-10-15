<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BookingCalendar extends Component
{
    public function render()
    {
        return view('livewire.booking-calendar');
    }
}

/**
 * BookingCalendar
 *
 * Livewire stub for a calendar/timeline view showing bookings per room.
 * Integrate a JS calendar library (FullCalendar, e.g.) via Livewire hooks.
 */
