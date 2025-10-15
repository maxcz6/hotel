<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener estadísticas generales
        $totalRooms = Room::count();
        $activeReservations = Reservation::where('status', 'active')
            ->whereDate('check_in', '<=', now())
            ->whereDate('check_out', '>=', now())
            ->count();

        // Calcular ingresos mensuales
        $monthlyRevenue = Reservation::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->where('status', 'active')
            ->sum('total_price');

        // Calcular tasa de ocupación
        $occupiedRooms = Room::whereHas('reservations', function ($query) {
            $query->where('status', 'active')
                ->whereDate('check_in', '<=', now())
                ->whereDate('check_out', '>=', now());
        })->count();
        
        $occupancyRate = $totalRooms > 0 
            ? round(($occupiedRooms / $totalRooms) * 100) 
            : 0;

        // Obtener próximas reservas
        $upcomingReservations = Reservation::with('room')
            ->where('check_in', '>=', now())
            ->where('status', 'confirmed')
            ->orderBy('check_in')
            ->limit(10)
            ->get();

        // Obtener todas las habitaciones con sus reservas actuales
        $rooms = Room::with(['currentReservation' => function ($query) {
            $query->where('status', 'active')
                ->whereDate('check_in', '<=', now())
                ->whereDate('check_out', '>=', now());
        }])->get();

        return view('admin.dashboard', compact(
            'totalRooms',
            'activeReservations',
            'monthlyRevenue',
            'occupancyRate',
            'upcomingReservations',
            'rooms'
        ));
    }

    public function getStats()
    {
        // Endpoint para actualización en tiempo real de estadísticas
        $stats = [
            'totalRooms' => Room::count(),
            'activeReservations' => Reservation::where('status', 'active')
                ->whereDate('check_in', '<=', now())
                ->whereDate('check_out', '>=', now())
                ->count(),
            'monthlyRevenue' => Reservation::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->where('status', 'active')
                ->sum('total_price'),
            'occupancyRate' => $this->calculateOccupancyRate()
        ];

        return response()->json($stats);
    }

    private function calculateOccupancyRate()
    {
        $totalRooms = Room::count();
        if ($totalRooms === 0) return 0;

        $occupiedRooms = Room::whereHas('reservations', function ($query) {
            $query->where('status', 'active')
                ->whereDate('check_in', '<=', now())
                ->whereDate('check_out', '>=', now());
        })->count();

        return round(($occupiedRooms / $totalRooms) * 100);
    }
}