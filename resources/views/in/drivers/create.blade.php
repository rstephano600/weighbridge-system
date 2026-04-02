@extends('layouts.app')

@section('content')

<h3>Add Driver</h3>

<form method="POST" action="{{ route('drivers.store') }}">
    @csrf

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control">
    </div>

    <div class="mb-3">
        <label>License Number</label>
        <input type="text" name="license_number" class="form-control">
    </div>

    <div class="mb-3">
        <label>Phone</label>
        <input type="text" name="phone" class="form-control">
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="Status" class="form-control">
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
        </select>
    </div>

    <button class="btn btn-success">Save</button>
</form>

@endsection