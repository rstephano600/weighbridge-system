@extends('layouts.app')

@section('content')

<h3>Truck Details</h3>

<div class="card">
    <div class="card-body">
        <p><strong>Plate:</strong> {{ $truck->plate_number }}</p>
        <p><strong>Company:</strong> {{ $truck->company }}</p>
        <p><strong>Capacity:</strong> {{ $truck->capacity }}</p>
        <p><strong>Status:</strong> {{ $truck->Status }}</p>
        <p><strong>User:</strong> {{ $truck->user->name ?? '-' }}</p>
    </div>
</div>

<a href="{{ route('trucks.index') }}" class="btn btn-secondary mt-3">Back</a>

@endsection