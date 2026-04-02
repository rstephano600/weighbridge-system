@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-3">Weigh OUT</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('weigh.out.store') }}">
        @csrf

        <div class="mb-3">
            <label>Select Transaction</label>
            <select name="transaction_id" class="form-control">
                @foreach($transactions as $trx)
                    <option value="{{ $trx->id }}">
                        {{ $trx->transaction_no }} - {{ $trx->truck->plate_number }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tare Weight</label>
            <input type="number" name="tare_weight" step="0.01" class="form-control">
        </div>

        <button class="btn btn-success">Complete</button>
    </form>
</div>
@endsection