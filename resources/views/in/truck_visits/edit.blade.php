@extends('layouts.app')

@section('content')

<h3>Edit Truck Visit</h3>

<form method="POST" action="{{ route('truck_visits.update', $truck_visit->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Truck</label>
        <select name="truck_id" class="form-control">
            @foreach($trucks as $truck)
                <option value="{{ $truck->id }}" {{ $truck_visit->truck_id == $truck->id ? 'selected' : '' }}>
                    {{ $truck->plate_number }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Driver</label>
        <select name="driver_id" class="form-control">
            @foreach($drivers as $driver)
                <option value="{{ $driver->id }}" {{ $truck_visit->driver_id == $driver->id ? 'selected' : '' }}>
                    {{ $driver->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Arrival Time</label>
        <input type="datetime-local" name="arrival_time"
            value="{{ \Carbon\Carbon::parse($truck_visit->arrival_time)->format('Y-m-d\TH:i') }}"
            class="form-control">
    </div>

    <div class="mb-3">
        <label>Departure Time</label>
        <input type="datetime-local" name="departure_time"
            value="{{ $truck_visit->departure_time ? \Carbon\Carbon::parse($truck_visit->departure_time)->format('Y-m-d\TH:i') : '' }}"
            class="form-control">
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="Status" class="form-control">
            <option value="Arrived" {{ $truck_visit->Status == 'Arrived' ? 'selected' : '' }}>Arrived</option>
            <option value="Departed" {{ $truck_visit->Status == 'Departed' ? 'selected' : '' }}>Departed</option>
        </select>
    </div>

    <button class="btn btn-primary">Update</button>
</form>

@endsection