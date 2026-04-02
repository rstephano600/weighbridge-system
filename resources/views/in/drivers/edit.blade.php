@extends('layouts.app')

@section('content')

<h3>Edit Driver</h3>

<form method="POST" action="{{ route('drivers.update', $driver->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" value="{{ $driver->name }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>License Number</label>
        <input type="text" name="license_number" value="{{ $driver->license_number }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Phone</label>
        <input type="text" name="phone" value="{{ $driver->phone }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="Status" class="form-control">
            <option value="Active" {{ $driver->Status == 'Active' ? 'selected' : '' }}>Active</option>
            <option value="Inactive" {{ $driver->Status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>

    <button class="btn btn-primary">Update</button>
</form>

@endsection