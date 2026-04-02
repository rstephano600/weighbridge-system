<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeighbridgeTransaction;
use App\Models\Truck;
use App\Models\Driver;

class WeighInController extends Controller
{
    // Show form
    public function index()
{
    $transactions = \App\Models\WeighbridgeTransaction::with(['truck', 'driver'])
        ->latest()
        ->get();

    return view('in.weight.in.index', compact('transactions'));
}
    public function create()
    {
        $trucks = Truck::all();
        $drivers = Driver::all();

        return view('in.weight.in.create', compact('trucks', 'drivers'));
    }

    

    // Store weigh-in
    public function store(Request $request)
    {
        $request->validate([
            'truck_id' => 'required',
            'driver_id' => 'required',
            'tare_weight' => 'required|numeric'
        ]);

        $transaction = WeighbridgeTransaction::create([
            'transaction_no' => 'TRX-' . now()->format('YmdHis'),
            'truck_id' => $request->truck_id,
            'driver_id' => $request->driver_id,
            'tare_weight' => $request->tare_weight,
            'material_id' => 1,
            'direction' => 'IN',
            'status' => 'pending',
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Weigh IN recorded successfully');
    }


    public function edit($id)
{
    $transaction = WeighbridgeTransaction::findOrFail($id);
    return view('in.weight.in.edit', compact('transaction'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'gross_weight' => 'required|numeric|gt:0',
    ]);

    $transaction = WeighbridgeTransaction::findOrFail($id);

    // Logic: Gross must be greater than Tare
    if ($request->gross_weight <= $transaction->tare_weight) {
        return redirect()->back()->withErrors(['gross_weight' => 'Gross weight must be greater than tare weight.']);
    }

    $netWeight = $request->gross_weight - $transaction->tare_weight;

    $transaction->update([
        'gross_weight' => $request->gross_weight,
        'net_weight'   => $netWeight,
        'direction'    => 'OUT', // Transitioning the status
    ]);

    return redirect()->route('weigh.in.index')->with('success', 'Weigh OUT completed successfully.');
}
}