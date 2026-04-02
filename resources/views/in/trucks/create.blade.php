@extends('layouts.app')

@section('content')

<h3>Add Truck</h3>

<form method="POST" action="{{ route('trucks.store') }}">
    @csrf

    <div class="mb-3">
        <label>Plate Number</label>
        <input type="text" name="plate_number" class="form-control">
    </div>

    <div class="mb-3">
        <label>Company</label>
        <input type="text" name="company" class="form-control">
    </div>

    <div class="mb-3">
        <label>Capacity</label>
        <input type="number" name="capacity" class="form-control">
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="Status" class="form-control">
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
        </select>
    </div>

    <div class="mb-3">
        <label>User</label>
        <select name="user_id" class="form-control">
            <option value="">-- Select User --</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-success">Save</button>
</form>

@endsection