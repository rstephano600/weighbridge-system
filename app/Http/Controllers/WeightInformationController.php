<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeighbridgeTransaction;
use App\Models\Truck;
use App\Models\Driver;
use App\Models\TruckVisit;
use Illuminate\Support\Facades\DB;

class WeightInformationController extends Controller

{
    public function weighInputTruck()
    {
        $transactions = WeighbridgeTransaction::with(['truck', 'driver', 'truckVisit'])
            ->latest()
            ->get();
        return view('in.weight.weighInputTruck', compact('transactions'));
    }

    public function weighInputTruckCreate()
    {
        $trucks = Truck::all();
        $drivers = Driver::all();
        $truckVisits = TruckVisit::where('direction', 'IN')->get();
        return view('in.weight.weighInputTruckCreate', compact('trucks', 'drivers', 'truckVisits'));
    }

    public function weighInputTruckStore(Request $request)
    {
        $request->validate([
            'truck_visit_id' => 'required',
            'tare_weight' => 'required|numeric'
        ]);

        $truckVisit = TruckVisit::findOrFail($request->truck_visit_id);
        $driverid = $truckVisit->driver_id;
        $truckid = $truckVisit->truck_id;

        $transaction = WeighbridgeTransaction::create([
            'transaction_no' => 'TRX-' . now()->format('YmdHis'),
            'truck_visit_id' => $request->truck_visit_id,
            'truck_id' => $truckid,
            'driver_id' => $driverid,
            'tare_weight' => $request->tare_weight,
            'material_id' => 1,
            'direction' => 'IN',
            'status' => 'pending',
            'user_id' => auth()->id(),
        ]);


        return redirect()->route('weighInputTruck')->with('success', 'Weigh IN recorded successfully.');
    }

    public function weighInputTruckPack($id)
    {
        $transaction = WeighbridgeTransaction::findOrFail($id);
        return view('in.weight.weighInputTruckPack', compact('transaction'));
    }

    public function weighInputTruckPackStore(Request $request, $id)
    {
        $request->validate([
            'gross_weight' => 'required|numeric|gt:0',
        ]);

        $transaction = WeighbridgeTransaction::findOrFail($id);
        if ($request->gross_weight <= $transaction->tare_weight) {
            return redirect()->back()->withErrors(['gross_weight' => 'Gross weight must be greater than tare weight.']);
        }
        $netWeight = $request->gross_weight - $transaction->tare_weight;
        DB::transaction(function () use ($transaction, $request, $netWeight) {
            $transaction->update([
                'gross_weight' => $request->gross_weight,
                'net_weight'   => $netWeight,
                'direction'    => 'OUT',
            ]);

            $truckVisit = TruckVisit::findOrFail($transaction->truck_visit_id);
            $truckVisit->update([
                'direction' => 'OUT',
                'departure_time' => now(),
            ]);

        });
        return redirect()->route('weighInputTruck')->with('success', 'Weigh OUT completed successfully.');
    }

    public function apiTrucks()
    {
    return response()->json(Truck::all());
    }
        
    public function apiDrivers()
    {
        return response()->json(Driver::all());
    }
    public function apiTruckVisitsIn()
    {
        $visits = TruckVisit::with(['truck', 'driver'])
            ->where('direction', 'IN')
            ->get();

        return response()->json($visits);
    }

    public function apiWeighIn(Request $request)
    {
        $request->validate([
            'truck_visit_id' => 'required',
            'tare_weight' => 'required|numeric'
        ]);

        $truckVisit = TruckVisit::findOrFail($request->truck_visit_id);

        $transaction = WeighbridgeTransaction::create([
            'transaction_no' => 'TRX-' . now()->format('YmdHis'),
            'truck_visit_id' => $truckVisit->id,
            'truck_id' => $truckVisit->truck_id,
            'driver_id' => $truckVisit->driver_id,
            'tare_weight' => $request->tare_weight,
            'material_id' => 1,
            'direction' => 'IN',
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Weigh IN recorded',
            'transaction' => $transaction
        ]);
    }

    public function apiWeighOut(Request $request, $id)
    {
        $request->validate([
            'gross_weight' => 'required|numeric|gt:0',
        ]);

        $transaction = WeighbridgeTransaction::findOrFail($id);

        if ($request->gross_weight <= $transaction->tare_weight) {
            return response()->json([
                'error' => 'Gross weight must be greater than tare weight'
            ], 400);
        }

        $netWeight = $request->gross_weight - $transaction->tare_weight;

        DB::transaction(function () use ($transaction, $request, $netWeight) {

            $transaction->update([
                'gross_weight' => $request->gross_weight,
                'net_weight'   => $netWeight,
                'direction'    => 'OUT',
                'status'       => 'completed'
            ]);

            $truckVisit = TruckVisit::findOrFail($transaction->truck_visit_id);

            $truckVisit->update([
                'direction' => 'OUT',
                'departure_time' => now(),
            ]);
        });

        return response()->json([
            'message' => 'Weigh OUT completed',
            'transaction' => $transaction
        ]);
    }

    public function apiPendingTransaction($visit_id)
    {
        $transaction = WeighbridgeTransaction::where('truck_visit_id', $visit_id)
            ->where('direction', 'IN')
            ->whereNull('gross_weight')
            ->latest()
            ->first();

        return response()->json($transaction);
    }
}

