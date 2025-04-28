<?php

namespace App\Http\Controllers;

use App\Models\AqiData;
use Illuminate\Http\Request;

class AqiDataController extends Controller
{
    public function index()
    {
        $aqiData = AqiData::with('sensor')->latest()->get();
        return view('aqi_data.index', compact('aqiData'));
    }
}

