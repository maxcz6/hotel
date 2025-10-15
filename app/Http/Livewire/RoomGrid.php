<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RoomGrid extends Component
{
    public function render()
    {
        return view('livewire.room-grid');
    }
}

/**
 * RoomGrid
 *
 * Livewire stub that will render the floor plan / grid of rooms as cards.
 * Each card should show number, type and status with color coding and allow
 * quick status changes.
 */
