<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DashboardStats extends Component
{
    public function render()
    {
        return view('livewire.dashboard-stats');
    }
}

/**
 * DashboardStats
 *
 * Livewire component that mostrará métricas en tiempo real: ocupación del día,
 * reservas recientes, y un breakdown de estados de habitaciones.
 */
