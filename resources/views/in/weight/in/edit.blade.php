@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Complete Weigh-Out (Gross Weight)</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('weigh.in.update', $transaction->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-bold">Transaction No:</label>
                            <input type="text" class="form-control bg-light" value="{{ $transaction->transaction_no }}" readonly>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Truck</label>
                                <input type="text" class="form-control bg-light" value="{{ $transaction->truck->plate_number }}" readonly>
                            </div>
                            <div class="col">
                                <label class="form-label">Driver</label>
                                <input type="text" class="form-control bg-light" value="{{ $transaction->driver->name }}" readonly>
                            </div>
                        </div>

                        <hr>

                        <div class="mb-3">
                            <label for="tare_weight" class="form-label">Tare Weight (kg)</label>
                            <input type="number" id="tare_weight" name="tare_weight" class="form-control bg-light" 
                                   value="{{ $transaction->tare_weight }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="gross_weight" class="form-label text-primary fw-bold">Gross Weight (kg)</label>
                            <input type="number" step="0.01" id="gross_weight" name="gross_weight" 
                                   class="form-control @error('gross_weight') is-invalid @enderror" 
                                   placeholder="Enter Gross Weight" required autofocus>
                            @error('gross_weight')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="net_weight" class="form-label text-success fw-bold">Calculated Net Weight (kg)</label>
                            <input type="number" id="net_weight" name="net_weight" class="form-control bg-light fw-bold" 
                                   value="0" readonly>
                            <small class="text-muted">Formula: Gross - Tare</small>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg">Save Transaction</button>
                            <a href="{{ route('weigh.in.index') }}" class="btn btn-link text-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tareInput = document.getElementById('tare_weight');
        const grossInput = document.getElementById('gross_weight');
        const netInput = document.getElementById('net_weight');

        function calculateNet() {
            const tare = parseFloat(tareInput.value) || 0;
            const gross = parseFloat(grossInput.value) || 0;
            const net = gross - tare;

            netInput.value = net > 0 ? net.toFixed(2) : 0;
            
            // Visual feedback: red if gross is logically impossible
            if(gross > 0 && gross <= tare) {
                grossInput.classList.add('is-invalid');
            } else {
                grossInput.classList.remove('is-invalid');
            }
        }

        grossInput.addEventListener('input', calculateNet);
    });
</script>
@endsection