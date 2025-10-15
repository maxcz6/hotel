<?php

namespace App\Http\Controllers;

use App\Models\Room;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::orderBy('number')->get();
        return view('rooms.index', compact('rooms'));
    }
}

/**
 * RoomController
 *
 * Controlador sencillo para vistas públicas de habitaciones (demo). En una
 * versión final esto podría delegar en Livewire components del módulo
 * RoomManagement para una UI completa del panel admin.
 */
