@extends('layouts.app')

@section('title', 'Bienvenido a Sumay Tika Hotel')

@section('content')
<div class="hero-section">
    <div class="hero-content">
        <h1>Bienvenido a Sumay Tika Hotel</h1>
        <p class="hero-subtitle">Descubre el confort y la elegancia en el corazón de la ciudad</p>
        <a href="{{ route('rooms.index') }}" class="btn btn-primary">Ver Habitaciones</a>
    </div>
</div>

<div class="features-section">
    <div class="container">
        <div class="features-grid">
            <div class="feature-card">
                <i class="fas fa-bed"></i>
                <h3>Habitaciones Confortables</h3>
                <p>Disfruta de nuestras habitaciones elegantemente amuebladas con todas las comodidades modernas.</p>
            </div>
            
            <div class="feature-card">
                <i class="fas fa-wifi"></i>
                <h3>WiFi Gratuito</h3>
                <p>Mantente conectado con acceso a internet de alta velocidad en todas nuestras instalaciones.</p>
            </div>
            
            <div class="feature-card">
                <i class="fas fa-concierge-bell"></i>
                <h3>Servicio 24/7</h3>
                <p>Nuestro personal está disponible las 24 horas para atender todas tus necesidades.</p>
            </div>
        </div>
    </div>
</div>

<div class="featured-rooms">
    <div class="container">
        <h2>Habitaciones Destacadas</h2>
        <div class="rooms-grid">
            @foreach($featuredRooms as $room)
            <div class="room-card">
                <div class="room-image">
                    <img src="{{ asset('images/rooms/default.jpg') }}" alt="Habitación {{ $room->number }}">
                </div>
                <div class="room-info">
                    <h3>{{ $room->type }}</h3>
                    <p class="room-price">${{ number_format($room->price, 2) }} / noche</p>
                    <p class="room-description">{{ Str::limit($room->description, 100) }}</p>
                    <a href="{{ route('reservations.create', $room) }}" class="btn btn-secondary">Reservar Ahora</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="cta-section">
    <div class="container">
        <h2>¿Listo para una experiencia inolvidable?</h2>
        <p>Reserva tu estancia hoy y disfruta de nuestras instalaciones de primera clase.</p>
        <a href="{{ route('rooms.index') }}" class="btn btn-primary">Explorar Todas las Habitaciones</a>
    </div>
</div>
@endsection

@push('styles')
<style>
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('images/hero-bg.jpg') }}');
        background-size: cover;
        background-position: center;
        height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
    }

    .hero-content {
        max-width: 800px;
        padding: 2rem;
    }

    .hero-content h1 {
        font-size: 3rem;
        margin-bottom: 1rem;
    }

    .hero-subtitle {
        font-size: 1.5rem;
        margin-bottom: 2rem;
    }

    .features-section {
        padding: 4rem 0;
        background: var(--color-gray-50);
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        padding: 2rem;
    }

    .feature-card {
        text-align: center;
        padding: 2rem;
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-sm);
        transition: transform 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-5px);
    }

    .feature-card i {
        font-size: 2.5rem;
        color: var(--color-primary);
        margin-bottom: 1rem;
    }

    .featured-rooms {
        padding: 4rem 0;
    }

    .rooms-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        padding: 2rem 0;
    }

    .room-card {
        background: white;
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: transform 0.3s ease;
    }

    .room-card:hover {
        transform: translateY(-5px);
    }

    .room-image img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .room-info {
        padding: 1.5rem;
    }

    .room-price {
        color: var(--color-primary);
        font-weight: bold;
        font-size: 1.25rem;
        margin: 0.5rem 0;
    }

    .cta-section {
        background: var(--color-primary);
        color: white;
        text-align: center;
        padding: 4rem 0;
    }

    .cta-section h2 {
        margin-bottom: 1rem;
    }

    .cta-section p {
        margin-bottom: 2rem;
    }

    @media (max-width: 768px) {
        .hero-content h1 {
            font-size: 2rem;
        }

        .hero-subtitle {
            font-size: 1.25rem;
        }

        .features-grid,
        .rooms-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush