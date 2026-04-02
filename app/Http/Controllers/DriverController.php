<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        // Show only drivers created by logged-in user
        $drivers = Driver::where('user_id', auth()->id())->latest()->get();

        return view('in.drivers.index', compact('drivers'));
    }

    public function create()
    {
        return view('in.drivers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'license_number' => 'required',
            'phone' => 'required',
            'Status' => 'required',
        ]);

        Driver::create([
            'name' => $request->name,
            'license_number' => $request->license_number,
            'phone' => $request->phone,
            'Status' => $request->Status,
            'user_id' => auth()->id(), // 🔥 important
        ]);

        return redirect()->route('drivers.index')->with('success', 'Driver created successfully');
    }

    public function show(Driver $driver)
    {
        $this->authorizeDriver($driver);

        return view('in.drivers.show', compact('driver'));
    }

    public function edit(Driver $driver)
    {
        $this->authorizeDriver($driver);

        return view('in.drivers.edit', compact('driver'));
    }

    public function update(Request $request, Driver $driver)
    {
        $this->authorizeDriver($driver);

        $request->validate([
            'name' => 'required',
            'license_number' => 'required',
            'phone' => 'required',
            'Status' => 'required',
        ]);

        $driver->update($request->only([
            'name',
            'license_number',
            'phone',
            'Status'
        ]));

        return redirect()->route('drivers.index')->with('success', 'Driver updated');
    }

    public function destroy(Driver $driver)
    {
        $this->authorizeDriver($driver);

        $driver->delete();

        return redirect()->route('drivers.index')->with('success', 'Driver deleted');
    }

    // 🔐 Security check
    private function authorizeDriver($driver)
    {
        if ($driver->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
    }
}