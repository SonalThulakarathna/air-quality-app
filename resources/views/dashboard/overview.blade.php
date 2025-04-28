@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-light d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2 text-primary">
                <rect x="3" y="3" width="7" height="7"></rect>
                <rect x="14" y="3" width="7" height="7"></rect>
                <rect x="14" y="14" width="7" height="7"></rect>
                <rect x="3" y="14" width="7" height="7"></rect>
            </svg>
            Dashboard Overview
        </h2>
        <div class="d-flex align-items-center">
            <span class="text-light me-3 d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2 text-muted">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                Last updated: {{ now()->format('g:i:s A') }}
            </span>
            <a href="{{ route('dashboard.overview') }}" class="btn btn-primary d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                    <polyline points="1 4 1 10 7 10"></polyline>
                    <polyline points="23 20 23 14 17 14"></polyline>
                    <path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path>
                </svg>
                Refresh
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4 g-3">
        <div class="col-md-3">
            <div class="card bg-dark border-0 shadow-lg h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-box bg-primary-subtle me-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Total Sensors</h6>
                            <h3 class="mb-0 text-light">{{ $totalSensors }}</h3>
                        </div>
                    </div>
                    <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card bg-dark border-0 shadow-lg h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-box bg-danger-subtle me-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                            </svg>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Active Alerts</h6>
                            <h3 class="mb-0 text-light">{{ $activeAlerts }}</h3>
                        </div>
                    </div>
                    <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card bg-dark border-0 shadow-lg h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-box bg-success-subtle me-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 20v-6M6 20V10M18 20V4"></path>
                            </svg>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Total Readings</h6>
                            <h3 class="mb-0 text-light">{{ $totalReadings }}</h3>
                        </div>
                    </div>
                    <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card bg-dark border-0 shadow-lg h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-box bg-info-subtle me-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                            </svg>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">System Health</h6>
                            <h3 class="mb-0 text-light">{{ $systemHealth }}</h3>
                        </div>
                    </div>
                    <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Sensor Readings Table -->
        <div class="col-md-6">
            <div class="card bg-dark border-0 shadow-lg">
                <div class="card-header bg-dark border-bottom border-secondary d-flex justify-content-between align-items-center py-3">
                    <h5 class="card-title mb-0 text-light d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2 text-primary">
                            <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                        </svg>
                        Sensor Readings
                    </h5>
                    <a href="#" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">Sensor ID</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                    <th class="pe-4">Latest Reading</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($sensorReadings as $sensor)
                                <tr>
                                    <td class="ps-4">{{ $sensor->id }}</td>
                                    <td>{{ $sensor->name }}</td>
                                    <td>
                                        <span class="badge bg-success-subtle text-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                            </svg>
                                            Active
                                        </span>
                                    </td>
                                    <td class="pe-4">
                                        <span class="fw-medium">{{ optional($sensor->aqiData->first())->aqi_value ?? '-' }}</span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Health Details -->
        <div class="col-md-6">
            <div class="card bg-dark border-0 shadow-lg">
                <div class="card-header bg-dark border-bottom border-secondary d-flex justify-content-between align-items-center py-3">
                    <h5 class="card-title mb-0 text-light d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2 text-info">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                        System Health Details
                    </h5>
                    <a href="#" class="btn btn-sm btn-outline-info">Diagnostics</a>
                </div>
                <div class="card-body text-center p-5">
                    @if($systemHealth === 'Healthy')
                        <div class="mb-3">
                            <div class="health-icon bg-success-subtle text-success mx-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                </svg>
                            </div>
                        </div>
                        <h4 class="text-success mb-2">System Healthy</h4>
                        <p class="text-muted mb-0">All systems are running smoothly with no detected issues.</p>
                    @else
                        <div class="mb-3">
                            <div class="health-icon bg-danger-subtle text-danger mx-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="8" x2="12" y2="12"></line>
                                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                </svg>
                            </div>
                        </div>
                        <h4 class="text-danger mb-2">System Needs Attention</h4>
                        <p class="text-muted mb-0">There are issues that require your immediate attention.</p>
                    @endif
                    
                    <div class="mt-4 pt-3 border-top border-secondary">
                        <div class="row g-0 text-start">
                            <div class="col-6 border-end border-secondary p-3">
                                <h6 class="text-muted mb-1">CPU Usage</h6>
                                <div class="d-flex align-items-center">
                                    <h5 class="mb-0 text-light">24%</h5>
                                    <div class="progress ms-2 flex-grow-1" style="height: 6px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 24%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 p-3">
                                <h6 class="text-muted mb-1">Memory Usage</h6>
                                <div class="d-flex align-items-center">
                                    <h5 class="mb-0 text-light">42%</h5>
                                    <div class="progress ms-2 flex-grow-1" style="height: 6px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 42%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
body {
    background-color: #0a0a0a;
    color: #e0e0e0;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
}

.card {
    border-radius: 0.75rem;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
    transition: transform 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
}

.card-header {
    background-color: #141414;
}

.table-dark {
    background-color: transparent;
    color: #e0e0e0;
}

.table-dark thead th {
    background-color: #141414;
    color: #9e9e9e;
    font-weight: 500;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.5px;
    border-bottom: none;
}

.table-dark tbody tr {
    border-color: #2a2a2a;
}

.table-dark tbody tr:hover {
    background-color: rgba(255, 255, 255, 0.05);
}

.icon-box {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.bg-primary-subtle {
    background-color: rgba(62, 166, 255, 0.15);
}

.bg-danger-subtle {
    background-color: rgba(255, 78, 69, 0.15);
}

.bg-success-subtle {
    background-color: rgba(43, 166, 64, 0.15);
}

.bg-info-subtle {
    background-color: rgba(62, 166, 255, 0.15);
}

.text-primary {
    color: #3ea6ff !important;
}

.text-danger {
    color: #ff4e45 !important;
}

.text-success {
    color: #2ba640 !important;
}

.text-info {
    color: #3ea6ff !important;
}

.btn-primary {
    background: linear-gradient(135deg, #2575fc 0%, #6a11cb 100%);
    border: none;
    box-shadow: 0 4px 15px rgba(37, 117, 252, 0.4);
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(37, 117, 252, 0.5);
}

.btn-outline-primary {
    color: #3ea6ff;
    border-color: #3ea6ff;
}

.btn-outline-primary:hover {
    background-color: rgba(62, 166, 255, 0.15);
    color: #3ea6ff;
}

.btn-outline-info {
    color: #3ea6ff;
    border-color: #3ea6ff;
}

.btn-outline-info:hover {
    background-color: rgba(62, 166, 255, 0.15);
    color: #3ea6ff;
}

.badge {
    padding: 0.35em 0.65em;
    font-weight: 500;
}

.health-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.progress {
    background-color: #2a2a2a;
    border-radius: 10px;
    overflow: hidden;
}
</style>
@endsection