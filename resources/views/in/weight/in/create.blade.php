@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-3">Weigh IN</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('weigh.in.store') }}">
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
            <label>Tare Weight</label>
            <input type="number" name="tare_weight" step="0.01" class="form-control">
        </div>

        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection