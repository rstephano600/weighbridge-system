<?php

namespace App\Http\Controllers;

use App\Models\TruckVisit;
use App\Models\Truck;
use App\Models\Driver;
use Illuminate\Http\Request;

class TruckVisitController extends Controller
{
    public function index()
    {
        $visits = TruckVisit::with(['truck', 'driver'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('in.truck_visits.index', compact('visits'));
    }

    public function create()
    {
        // Only user-owned trucks & drivers
        $trucks = Truck::where('user_id', auth()->id())->get();
        $drivers = Driver::where('user_id', auth()->id())->get();

        return view('in.truck_visits.create', compact('trucks', 'drivers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'truck_id' => 'required|exists:trucks,id',
            'driver_id' => 'required|exists:drivers,id',
            'arrival_time' => 'required|date',
        ]);

        // 🔐 Ensure ownership
        $this->checkOwnership($request->truck_id, $request->driver_id);

        $truck = Truck::findOrFail($request->truck_id);
        $driver = Driver::findOrFail($request->driver_id);
        $truckVisitRefNo = $truck->plate_number . '-' . $driver->name . '-' . now()->format('Ymd');
        $truckVisitRefNo = str_replace(' ', '', $truckVisitRefNo);

        TruckVisit::create([
            'truckVisitRefNo' => $truckVisitRefNo,
            'truck_id' => $request->truck_id,
            'driver_id' => $request->driver_id,
            'arrival_time' => $request->arrival_time,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('truck_visits.index')->with('success', 'Visit recorded');
    }

    public function show(TruckVisit $truck_visit)
    {
        $this->authorizeVisit($truck_visit);

        return view('in.truck_visits.show', compact('truck_visit'));
    }

    public function edit(TruckVisit $truck_visit)
    {
        $this->authorizeVisit($truck_visit);

        $trucks = Truck::where('user_id', auth()->id())->get();
        $drivers = Driver::where('user_id', auth()->id())->get();

        return view('in.truck_visits.edit', compact('truck_visit', 'trucks', 'drivers'));
    }

    public function update(Request $request, TruckVisit $truck_visit)
    {
        $this->authorizeVisit($truck_visit);

        $request->validate([
            'truck_id' => 'required|exists:trucks,id',
            'driver_id' => 'required|exists:drivers,id',
            'arrival_time' => 'required|date',
            'departure_time' => 'nullable|date|after_or_equal:arrival_time',
            'Status' => 'required',
        ]);

        $this->checkOwnership($request->truck_id, $request->driver_id);

        $truck_visit->update($request->only([
            'truck_id',
            'driver_id',
            'arrival_time',
            'departure_time',
            'Status',
        ]));

        return redirect()->route('truck_visits.index')->with('success', 'Visit updated');
    }

    public function destroy(TruckVisit $truck_visit)
    {
        $this->authorizeVisit($truck_visit);

        $truck_visit->delete();

        return redirect()->route('truck_visits.index')->with('success', 'Visit deleted');
    }

    // 🔐 Ensure visit belongs to user
    private function authorizeVisit($visit)
    {
        if ($visit->user_id !== auth()->id()) {
            abort(403);
        }
    }

    // 🔐 Ensure selected truck & driver belong to user
    private function checkOwnership($truck_id, $driver_id)
    {
        $truck = Truck::findOrFail($truck_id);
        $driver = Driver::findOrFail($driver_id);

        if ($truck->user_id !== auth()->id() || $driver->user_id !== auth()->id()) {
            abort(403, 'Unauthorized selection');
        }
    }
}