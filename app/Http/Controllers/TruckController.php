<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use App\Models\User;
use Illuminate\Http\Request;

class TruckController extends Controller
{
    public function index()
    {
        $trucks = Truck::with('user')->latest()->get();
        return view('in.trucks.index', compact('trucks'));
    }

    public function create()
    {
        $users = User::all();
        return view('in.trucks.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plate_number' => 'required',
            'company' => 'required',
            'capacity' => 'required|numeric',
            'Status' => 'required',
            'user_id' => 'nullable|exists:users,id',
        ]);

        Truck::create($request->all());

        return redirect()->route('trucks.index')->with('success', 'Truck created successfully');
    }

    public function show(Truck $truck)
    {
        return view('in.trucks.show', compact('truck'));
    }

    public function edit(Truck $truck)
    {
        $users = User::all();
        return view('in.trucks.edit', compact('truck', 'users'));
    }

    public function update(Request $request, Truck $truck)
    {
        $request->validate([
            'plate_number' => 'required',
            'company' => 'required',
            'capacity' => 'required|numeric',
            'Status' => 'required',
        ]);

        $truck->update($request->all());

        return redirect()->route('trucks.index')->with('success', 'Truck updated successfully');
    }

    public function destroy(Truck $truck)
    {
        $truck->delete();

        return redirect()->route('trucks.index')->with('success', 'Truck deleted');
    }
}