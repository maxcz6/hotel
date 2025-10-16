@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-xl font-bold mb-4">Edit Room</h1>
    <form action="{{ route('rooms.update', $room) }}" method="POST">
        @method('PUT')
        @include('rooms._form')
    </form>
</div>
@endsection
