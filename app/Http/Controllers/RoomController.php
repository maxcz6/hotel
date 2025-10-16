<?php
namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::orderBy('number')->paginate(15);
        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'number' => 'required|string|unique:rooms,number',
            'type' => 'nullable|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'capacity' => 'nullable|integer',
            'status' => 'nullable|string',
            'amenities' => 'nullable|array',
        ]);

        Room::create($data);

        return redirect()->route('rooms.index')->with('success', 'Room created');
    }

    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $data = $request->validate([
            'number' => 'required|string|unique:rooms,number,' . $room->id,
            'type' => 'nullable|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'capacity' => 'nullable|integer',
            'status' => 'nullable|string',
            'amenities' => 'nullable|array',
        ]);

        $room->update($data);

        return redirect()->route('rooms.index')->with('success', 'Room updated');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Room deleted');
    }
}
