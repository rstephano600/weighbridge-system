@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Truck Visits</h3>
    <a href="{{ route('truck_visits.create') }}" class="btn btn-primary">Add Visit</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>VisitRefNo</th>
            <th>Distatch Status</th>
            <th>Truck</th>
            <th>Driver</th>
            <th>Arrival</th>
            <th>Departure</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($visits as $visit)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $visit->truckVisitRefNo }}</td>
            <td>{{ $visit->direction ?? '-' }}</td>
            <td>{{ $visit->truck->plate_number ?? '-' }}</td>
            <td>{{ $visit->driver->name ?? '-' }}</td>
            <td>{{ $visit->arrival_time ?? '-'}}</td>
            <td>{{ $visit->departure_time ?? '-'}}</td>
            <td>{{ $visit->Status }}</td>
            <td>
                <a href="{{ route('truck_visits.show', $visit->id) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('truck_visits.edit', $visit->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('truck_visits.destroy', $visit->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection