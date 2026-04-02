<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeighbridgeTransaction;

class WeighOutController extends Controller
{
    // Show form (list pending transactions)
    public function create()
    {
        $transactions = WeighbridgeTransaction::where('status', 'pending')->get();

        return view('in.weight.out.index', compact('transactions'));
    }

    // Store weigh-out
    public function store(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required',
            'gross_weight' => 'required|numeric'
        ]);

        $transaction = WeighbridgeTransaction::findOrFail($request->transaction_id);

        if ($transaction->status === 'completed') {
            return back()->with('error', 'Transaction already completed');
        }

        $transaction->gross_weight = $request->gross_weight;

        // 🔥 NET CALCULATION
        $transaction->net_weight = $transaction->gross_weight - $request->tare_weight;

        $transaction->direction = 'OUT';
        $transaction->status = 'completed';

        $transaction->save();

        return redirect()->back()->with('success', 'Weigh OUT completed successfully');
    }
}