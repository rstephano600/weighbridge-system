@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-3">Weigh IN</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('weighInputTruckStore') }}">
        @csrf

        <div class="mb-3">
            <label>Truck Visitors</label>
            <select name="truck_visit_id" class="form-control">
                @foreach($truckVisits as $truckVisit)
                    <option value="{{ $truckVisit->id }}">{{ $truckVisit->truckVisitRefNo }}</option>
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