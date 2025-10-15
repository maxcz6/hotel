<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sumay Tika - @yield('title', 'Hotel Boutique')</title>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body>
    <header class="nav-header">
        <div class="nav-container">
            <a href="{{ route('rooms.index') }}" class="hotel-logo">Sumay Tika</a>
            <nav class="main-nav">
                <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Habitaciones</a>
            </nav>
        </div>
    </header>

    <main>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <footer>
        <div class="nav-container">
            <p>&copy; {{ date('Y') }} Sumay Tika. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="{{ asset('js/custom.js') }}"></script>
    @yield('scripts')
</body>
</html>