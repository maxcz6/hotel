<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rooms</title>
</head>
<body>
    <h1>Rooms</h1>

    @if(session('success'))
        <div style="color:green">{{ session('success') }}</div>
    @endif

    <ul>
        @foreach($rooms as $room)
            <li>
                <strong>Room {{ $room->number }}</strong> — {{ $room->type }} — ${{ number_format($room->price,2) }}
                <a href="{{ route('reservations.create', $room) }}">Reserve</a>
            </li>
        @endforeach
    </ul>
</body>
</html>
