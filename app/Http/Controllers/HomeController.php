<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Obtener algunas habitaciones destacadas (por ejemplo, las más económicas o mejor valoradas)
        $featuredRooms = Room::where('status', 'available')
            ->take(3)
            ->get();

        return view('home', compact('featuredRooms'));
    }
}