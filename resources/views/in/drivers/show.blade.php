@extends('layouts.app')

@section('content')

<h3>Driver Details</h3>

<div class="card">
    <div class="card-body">
        <p><strong>Name:</strong> {{ $driver->name }}</p>
        <p><strong>License:</strong> {{ $driver->license_number }}</p>
        <p><strong>Phone:</strong> {{ $driver->phone }}</p>
        <p><strong>Status:</strong> {{ $driver->Status }}</p>
    </div>
</div>

<a href="{{ route('drivers.index') }}" class="btn btn-secondary mt-3">Back</a>

@endsection