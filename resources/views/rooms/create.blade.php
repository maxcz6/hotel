@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-xl font-bold mb-4">New Room</h1>
    <form action="{{ route('rooms.store') }}" method="POST">
        @include('rooms._form')
    </form>
</div>
@endsection
