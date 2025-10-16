@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Rooms</h1>
        <a href="{{ route('rooms.create') }}" class="btn btn-primary">New Room</a>
    </div>

    @if(session('success'))
        <div class="p-3 bg-green-100 text-green-800 mb-4">{{ session('success') }}</div>
    @endif

    <table class="min-w-full bg-white shadow rounded">
        <thead>
            <tr>
                <th class="px-4 py-2">#</th>
                <th class="px-4 py-2">Number</th>
                <th class="px-4 py-2">Type</th>
                <th class="px-4 py-2">Price</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($rooms as $room)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $room->id }}</td>
                <td class="px-4 py-2">{{ $room->number }}</td>
                <td class="px-4 py-2">{{ $room->type }}</td>
                <td class="px-4 py-2">{{ number_format($room->price,2) }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('rooms.show', $room) }}" class="text-blue-600 mr-2">View</a>
                    <a href="{{ route('rooms.edit', $room) }}" class="text-yellow-600 mr-2">Edit</a>
                    <form action="{{ route('rooms.destroy', $room) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button class="text-red-600" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="mt-4">{{ $rooms->links() }}</div>
</div>
@endsection
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
