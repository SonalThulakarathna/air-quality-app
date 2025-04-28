<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use App\Models\User;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    public function index()
    {
        $sensors = Sensor::with('installer')->get();
        return view('sensors.index', compact('sensors'));
    }

    public function create()
    {
        $users = User::all();
        return view('sensors.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sensor_id' => 'required|string|max:255|unique:sensors',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'location_description' => 'nullable|string',
            'installed_by' => 'required|exists:users,id',
        ]);

        Sensor::create($request->all());
        return redirect()->route('sensors.index')->with('success', 'Sensor created successfully.');
    }

    public function edit(Sensor $sensor)
    {
        $users = User::all();
        return view('sensors.edit', compact('sensor', 'users'));
    }

    public function update(Request $request, Sensor $sensor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sensor_id' => 'required|string|max:255|unique:sensors,sensor_id,' . $sensor->id,
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'location_description' => 'nullable|string',
            'installed_by' => 'required|exists:users,id',
        ]);

        $sensor->update($request->all());
        return redirect()->route('sensors.index')->with('success', 'Sensor updated successfully.');
    }

    public function destroy(Sensor $sensor)
    {
        $sensor->delete();
        return redirect()->route('sensors.index')->with('success', 'Sensor deleted successfully.');
    }
}

