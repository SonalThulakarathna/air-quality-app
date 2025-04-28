<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    public function index()
    {
        $alerts = Alert::with('sensor')->orderBy('triggered_at', 'desc')->get();
        return view('alerts.index', compact('alerts'));
    }

    public function resolve(Alert $alert)
    {
        $alert->update(['status' => 'resolved']);
        return redirect()->route('alerts.index');
    }
}

