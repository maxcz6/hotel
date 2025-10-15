@extends('layouts.app')

@section('title', 'Panel de Administración')

@section('content')
<div class="admin-dashboard">
    <!-- Header del Dashboard -->
    <div class="dashboard-header">
        <h1>Panel de Administración</h1>
        <div class="quick-actions">
            <a href="{{ route('rooms.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nueva Habitación
            </a>
            <a href="{{ route('reservations.index') }}" class="btn btn-secondary">
                <i class="fas fa-calendar"></i> Ver Reservas
            </a>
        </div>
    </div>

    <!-- Tarjetas de Estadísticas -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-bed"></i>
            </div>
            <div class="stat-content">
                <h3>Habitaciones</h3>
                <p class="stat-number">{{ $totalRooms }}</p>
                <p class="stat-label">Total de habitaciones</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div class="stat-content">
                <h3>Reservas Activas</h3>
                <p class="stat-number">{{ $activeReservations }}</p>
                <p class="stat-label">Reservas en curso</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="stat-content">
                <h3>Ingresos</h3>
                <p class="stat-number">${{ number_format($monthlyRevenue, 2) }}</p>
                <p class="stat-label">Este mes</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-percentage"></i>
            </div>
            <div class="stat-content">
                <h3>Ocupación</h3>
                <p class="stat-number">{{ $occupancyRate }}%</p>
                <p class="stat-label">Tasa de ocupación</p>
            </div>
        </div>
    </div>

    <!-- Lista de Próximas Reservas -->
    <div class="upcoming-reservations">
        <h2>Próximas Reservas</h2>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Habitación</th>
                        <th>Huésped</th>
                        <th>Entrada</th>
                        <th>Salida</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($upcomingReservations as $reservation)
                    <tr>
                        <td>{{ $reservation->room->number }}</td>
                        <td>{{ $reservation->guest_name }}</td>
                        <td>{{ $reservation->check_in->format('d/m/Y') }}</td>
                        <td>{{ $reservation->check_out->format('d/m/Y') }}</td>
                        <td>
                            <span class="status-badge status-{{ $reservation->status }}">
                                {{ ucfirst($reservation->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('reservations.show', $reservation) }}" class="btn-icon" title="Ver detalles">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('reservations.edit', $reservation) }}" class="btn-icon" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Estado de las Habitaciones -->
    <div class="room-status-grid">
        <h2>Estado de las Habitaciones</h2>
        <div class="room-grid">
            @foreach($rooms as $room)
            <div class="room-card status-{{ $room->status }}">
                <div class="room-card-header">
                    <h3>Habitación {{ $room->number }}</h3>
                    <span class="room-type">{{ $room->type }}</span>
                </div>
                <div class="room-card-body">
                    <p class="room-status">{{ ucfirst($room->status) }}</p>
                    @if($room->current_reservation)
                    <p class="room-guest">
                        <i class="fas fa-user"></i>
                        {{ $room->current_reservation->guest_name }}
                    </p>
                    <p class="room-dates">
                        {{ $room->current_reservation->check_in->format('d/m') }} - 
                        {{ $room->current_reservation->check_out->format('d/m') }}
                    </p>
                    @endif
                </div>
                <div class="room-card-actions">
                    <a href="{{ route('rooms.show', $room) }}" class="btn-text">Ver detalles</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animación para las tarjetas de estadísticas
    const statCards = document.querySelectorAll('.stat-card');
    statCards.forEach((card, index) => {
        setTimeout(() => {
            card.classList.add('show');
        }, index * 100);
    });

    // Actualización en tiempo real de los datos (si se implementa)
    const updateStats = () => {
        fetch('/api/dashboard/stats')
            .then(response => response.json())
            .then(data => {
                // Actualizar los valores de las estadísticas
            })
            .catch(error => console.error('Error:', error));
    };

    // Actualizar cada 5 minutos
    setInterval(updateStats, 300000);
});
</script>
@endpush