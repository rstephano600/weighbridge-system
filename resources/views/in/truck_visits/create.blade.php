@extends('layouts.app')

@section('content')

<h3>Add Truck Visit</h3>

<form method="POST" action="{{ route('truck_visits.store') }}">
    @csrf

    <div class="mb-3">
        <label>Truck</label>
        <select name="truck_id" class="form-control">
            @foreach($trucks as $truck)
                <option value="{{ $truck->id }}">{{ $truck->plate_number }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Driver</label>
        <select name="driver_id" class="form-control">
            @foreach($drivers as $driver)
                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Arrival Time</label>
        <input type="datetime-local" name="arrival_time" class="form-control">
    </div>


    <button class="btn btn-success">Save</button>
</form>

@endsection