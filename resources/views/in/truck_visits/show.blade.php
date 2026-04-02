@extends('layouts.app')

@section('content')

<h3>Visit Details</h3>

<div class="card">
    <div class="card-body">
        <p><strong>Truck:</strong> {{ $truck_visit->truck->plate_number }}</p>
        <p><strong>Driver:</strong> {{ $truck_visit->driver->name }}</p>
        <p><strong>Arrival:</strong> {{ $truck_visit->arrival_time }}</p>
        <p><strong>Departure:</strong> {{ $truck_visit->departure_time }}</p>
        <p><strong>Status:</strong> {{ $truck_visit->Status }}</p>
    </div>
</div>

<a href="{{ route('truck_visits.index') }}" class="btn btn-secondary mt-3">Back</a>

@endsection