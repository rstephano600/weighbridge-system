@extends('layouts.app')

@section('content')

<h3>Edit Truck</h3>

<form method="POST" action="{{ route('trucks.update', $truck->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Plate Number</label>
        <input type="text" name="plate_number" value="{{ $truck->plate_number }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Company</label>
        <input type="text" name="company" value="{{ $truck->company }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Capacity</label>
        <input type="number" name="capacity" value="{{ $truck->capacity }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="Status" class="form-control">
            <option value="Active" {{ $truck->Status == 'Active' ? 'selected' : '' }}>Active</option>
            <option value="Inactive" {{ $truck->Status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>

    <div class="mb-3">
        <label>User</label>
        <select name="user_id" class="form-control">
            <option value="">-- Select User --</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $truck->user_id == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-primary">Update</button>
</form>

@endsection