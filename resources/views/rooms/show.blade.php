@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Room #{{ $room->number }}</h1>
    <div class="mb-2"><strong>Type:</strong> {{ $room->type }}</div>
    <div class="mb-2"><strong>Price:</strong> {{ number_format($room->price,2) }}</div>
    <div class="mb-2"><strong>Capacity:</strong> {{ $room->capacity }}</div>
    <div class="mb-2"><strong>Description:</strong> {{ $room->description }}</div>
    <a href="{{ route('rooms.index') }}" class="text-blue-600">Back</a>
</div>
@endsection
