@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-3">Weigh In Transactions</h3>

    <a href="{{ route('weigh.in.create') }}" class="btn btn-primary mb-3">
        + New Weigh IN
    </a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Transaction</th>
                <th>Truck</th>
                <th>Driver</th>
                <th>Direction</th>
                <th>Tare</th>
                <th>Gross</th>
                <th>Net</th>
                <th>Actions</th>
                <th>Status</th>
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
                <td>{{ $trx->direction }}</td>
                <td>{{ $trx->tare_weight }}</td>
                <td>{{ $trx->gross_weight ?? 'N/A'}}</td>
                <td>{{ $trx->net_weight ?? 'N/A'}}</td>

                <td>
                    @if($trx->direction == 'IN')
                        <a href="{{ route('weigh.in.edit', $trx->id) }}" class="btn btn-sm btn-success">
                            Complete Weigh-Out
                        </a>
                    @else
                        <span class="text-muted">Completed</span>
                    @endif
                </td>
                <td>
                    <span class="badge bg-warning text-dark">
                        {{ $trx->Status }}
                    </span>
                </td>
                <td>{{ $trx->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection