@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Drivers</h3>
    <a href="{{ route('drivers.create') }}" class="btn btn-primary">Add Driver</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>License</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($drivers as $driver)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $driver->name }}</td>
            <td>{{ $driver->license_number }}</td>
            <td>{{ $driver->phone }}</td>
            <td>{{ $driver->Status }}</td>
            <td>
                <a href="{{ route('drivers.show', $driver->id) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('drivers.edit', $driver->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('drivers.destroy', $driver->id) }}" method="POST" style="display:inline;">
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