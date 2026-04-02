@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Trucks</h3>
    <a href="{{ route('trucks.create') }}" class="btn btn-primary">Add Truck</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Plate</th>
            <th>Company</th>
            <th>Capacity</th>
            <th>Status</th>
            <th>User</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($trucks as $truck)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $truck->plate_number }}</td>
            <td>{{ $truck->company }}</td>
            <td>{{ $truck->capacity }}</td>
            <td>{{ $truck->Status }}</td>
            <td>{{ $truck->user->name ?? '-' }}</td>
            <td>
                <a href="{{ route('trucks.show', $truck->id) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('trucks.edit', $truck->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('trucks.destroy', $truck->id) }}" method="POST" style="display:inline;">
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