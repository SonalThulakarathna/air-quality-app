<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use App\Models\Alert;
use App\Models\AqiData;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $sensors = Sensor::with('installer')->get();
        return view('dashboard', compact('sensors'));
    }

    public function overview()
    {
        $totalSensors = Sensor::count();
        $activeAlerts = Alert::where('status', 'active')->count();
        $totalReadings = AqiData::count();
        $systemHealth = $activeAlerts > 0 ? 'Attention Needed' : 'Healthy';

        // Get latest AQI for each sensor
        $sensorReadings = Sensor::with(['aqiData' => function($q) {
            $q->latest('recorded_at');
        }])->get();

        return view('dashboard.overview', compact(
            'totalSensors', 'activeAlerts', 'totalReadings', 'systemHealth', 'sensorReadings'
        ));
    }
} 