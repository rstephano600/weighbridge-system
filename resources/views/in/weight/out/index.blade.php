@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-3">Completed Weigh Transactions</h3>

    <a href="{{ route('weigh.out.create') }}" class="btn btn-primary mb-3">
        + New Weigh OUT
    </a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Transaction</th>
                <th>Truck</th>
                <th>Driver</th>
                <th>Gross</th>
                <th>Tare</th>
                <th>Net</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $trx)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $trx->transaction_no }}</td>
                <td>{{ $trx->truck->plate_number }}</td>
                <td>{{ $trx->driver->name }}</td>
                <td>{{ $trx->gross_weight }}</td>
                <td>{{ $trx->tare_weight }}</td>
                <td>{{ $trx->net_weight }}</td>
                <td>{{ $trx->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection