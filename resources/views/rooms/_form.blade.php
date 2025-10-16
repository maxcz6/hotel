@csrf
<div class="mb-4">
    <label class="block">Number</label>
    <input type="text" name="number" value="{{ old('number', $room->number ?? '') }}" class="w-full border p-2" required>
</div>
<div class="mb-4">
    <label class="block">Type</label>
    <input type="text" name="type" value="{{ old('type', $room->type ?? '') }}" class="w-full border p-2">
</div>
<div class="mb-4">
    <label class="block">Price</label>
    <input type="number" step="0.01" name="price" value="{{ old('price', $room->price ?? '') }}" class="w-full border p-2" required>
</div>
<div class="mb-4">
    <label class="block">Capacity</label>
    <input type="number" name="capacity" value="{{ old('capacity', $room->capacity ?? '') }}" class="w-full border p-2">
</div>
<div class="mb-4">
    <label class="block">Description</label>
    <textarea name="description" class="w-full border p-2">{{ old('description', $room->description ?? '') }}</textarea>
</div>
<div>
    <button class="btn btn-primary">Save</button>
</div>
