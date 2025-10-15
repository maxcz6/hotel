<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Guest;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function create(Room $room)
    {
        return view('reservations.create', compact('room'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        $room = Room::findOrFail($data['room_id']);

        $guest = Guest::create([
            'name' => $data['name'],
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
        ]);

        $nights = (new \DateTime($data['check_out']))->diff(new \DateTime($data['check_in']))->days;
        $total = $nights * $room->price;

        $reservation = Reservation::create([
            'room_id' => $room->id,
            'guest_id' => $guest->id,
            'check_in' => $data['check_in'],
            'check_out' => $data['check_out'],
            'total_price' => $total,
        ]);

        return redirect()->route('rooms.index')->with('success', 'Reservation created successfully.');
    }
}

/**
 * ReservationController
 *
 * Controlador demo para crear reservas desde una vista pública. En el PMS
 * real la creación de reservas debería usar `BookingService` y Livewire
 * para una experiencia completa y validada.
 */
