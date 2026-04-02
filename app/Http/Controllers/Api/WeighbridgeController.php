<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WeighbridgeReading;

class WeighbridgeController extends Controller
{
    public function ingest(Request $request)
    {
        $validated = $request->validate([
            'indicator_id' => 'required|string',
            'weight'       => 'required|integer|min:0',
            'unit'         => 'required|string',
            'stable'       => 'required|boolean',
            'timestamp'    => 'required|date',
        ]);

        WeighbridgeReading::create([
            'indicator_id' => $validated['indicator_id'],
            'weight'       => $validated['weight'],
            'unit'         => $validated['unit'],
            'stable'       => $validated['stable'],
            'reading_time' => $validated['timestamp'],
        ]);

        return response()->json(['status' => 'ok'], 200);
    }
}
