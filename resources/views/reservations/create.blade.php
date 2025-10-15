<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reserve Room {{ $room->number }}</title>
</head>
<body>
    <h1>Reserve Room {{ $room->number }}</h1>

    @if($errors->any())
        <div style="color:red">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('reservations.store') }}">
        @csrf
        <input type="hidden" name="room_id" value="{{ $room->id }}">

        <label>Name: <input type="text" name="name" value="{{ old('name') }}"></label><br>
        <label>Email: <input type="email" name="email" value="{{ old('email') }}"></label><br>
        <label>Phone: <input type="text" name="phone" value="{{ old('phone') }}"></label><br>
        <label>Check-in: <input type="date" name="check_in" value="{{ old('check_in') }}"></label><br>
        <label>Check-out: <input type="date" name="check_out" value="{{ old('check_out') }}"></label><br>

        <button type="submit">Book</button>
    </form>

    <p><a href="{{ route('rooms.index') }}">Back to rooms</a></p>
</body>
</html>
