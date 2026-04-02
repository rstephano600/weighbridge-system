@extends('layouts.app')

@section('content')

<h3 class="mb-4">Dashboard</h3>

<div class="row">

    <div class="col-md-4">
        <div class="card text-white bg-primary shadow">
            <div class="card-body">
                <h5>Total Users</h5>
                <h2>3</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-white bg-success shadow">
            <div class="card-body">
                <h5>Active Sessions</h5>
                <h2>5</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-white bg-warning shadow">
            <div class="card-body">
                <h5>Pending Tasks</h5>
                <h2>2</h2>
            </div>
        </div>
    </div>

</div>

@endsection