@extends('layouts.app')

@section('styles')
<style>
    :root {
        --bg-primary: #121212;
        --bg-secondary: #1e1e1e;
        --bg-card: #2d2d2d;
        --text-primary: #ffffff;
        --text-secondary: #b0b0b0;
        --border-color: #3a3a3a;
        --accent-blue: #4dabf7;
        --accent-green: #51cf66;
        --accent-yellow: #fcc419;
        --accent-orange: #ff922b;
        --accent-red: #ff6b6b;
        --accent-purple: #9775fa;
    }

    body {
        background-color: var(--bg-primary);
        color: var(--text-primary);
    }

    .aqi-container {
        padding: 2rem;
        max-width: 1600px;
        margin: 0 auto;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2.5rem;
    }

    .page-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .page-title svg {
        color: var(--accent-blue);
    }

    .header-actions {
        display: flex;
        gap: 1.25rem;
        align-items: center;
    }

    .time-filter {
        display: flex;
        gap: 0.75rem;
    }

    .time-btn {
        padding: 0.5rem 1rem;
        border-radius: 6px;
        background-color: var(--bg-secondary);
        color: var(--text-secondary);
        border: 1px solid var(--border-color);
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .time-btn.active {
        background-color: var(--accent-blue);
        color: white;
        border-color: var(--accent-blue);
    }

    .time-btn:hover {
        border-color: var(--accent-blue);
    }

    /* Card */
    .card {
        background-color: var(--bg-card);
        border-radius: 12px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        border: none;
        margin-bottom: 2rem;
    }

    .card-header {
        padding: 1.5rem 2rem;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .card-title svg {
        color: var(--accent-purple);
    }

    .card-body {
        padding: 0;
    }

    /* Table */
    .table-container {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .data-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .data-table th {
        background-color: var(--bg-secondary);
        color: var(--text-secondary);
        font-weight: 600;
        text-align: left;
        padding: 1rem 1.5rem;
        font-size: 0.8125rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .data-table th:first-child {
        border-top-left-radius: 12px;
        padding-left: 2rem;
    }

    .data-table th:last-child {
        border-top-right-radius: 12px;
        padding-right: 2rem;
    }

    .data-table td {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--border-color);
        font-size: 0.9375rem;
        color: var(--text-primary);
        vertical-align: middle;
    }

    .data-table td:first-child {
        padding-left: 2rem;
    }

    .data-table td:last-child {
        padding-right: 2rem;
    }

    .data-table tr:last-child td {
        border-bottom: none;
    }

    .data-table tr:hover td {
        background-color: rgba(77, 171, 247, 0.05);
    }

    /* AQI Badge */
    .aqi-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.375rem 0.875rem;
        border-radius: 50px;
        font-size: 0.875rem;
        font-weight: 600;
        gap: 0.5rem;
    }

    .aqi-good {
        background-color: rgba(81, 207, 102, 0.15);
        color: var(--accent-green);
    }

    .aqi-moderate {
        background-color: rgba(252, 196, 25, 0.15);
        color: var(--accent-yellow);
    }

    .aqi-unhealthy-sensitive {
        background-color: rgba(255, 146, 43, 0.15);
        color: var(--accent-orange);
    }

    .aqi-unhealthy {
        background-color: rgba(255, 107, 107, 0.15);
        color: var(--accent-red);
    }

    /* Summary Cards */
    .summary-cards {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .summary-card {
        background-color: var(--bg-card);
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .summary-card-title {
        font-size: 0.875rem;
        color: var(--text-secondary);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .summary-card-value {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }

    .summary-card-description {
        font-size: 0.8125rem;
        color: var(--text-secondary);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .aqi-container {
            padding: 1.25rem;
        }
        
        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }
        
        .header-actions {
            width: 100%;
            overflow-x: auto;
            padding-bottom: 0.5rem;
        }
        
        .time-filter {
            gap: 0.5rem;
        }
        
        .card-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
            padding: 1.25rem;
        }
    }
</style>
@endsection

@section('content')
<div class="aqi-container">
    <div class="page-header">
        <h1 class="page-title">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
            </svg>
            Air Quality Index Dashboard
        </h1>
        
        <div class="header-actions">
            <div class="time-filter">
                <button class="time-btn active">24h</button>
                <button class="time-btn">7d</button>
                <button class="time-btn">30d</button>
                <button class="time-btn">All</button>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="summary-cards">
        <div class="summary-card">
            <div class="summary-card-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                Current AQI
            </div>
            <div class="summary-card-value aqi-good">42</div>
            <div class="summary-card-description">Good air quality</div>
        </div>
        
        <div class="summary-card">
            <div class="summary-card-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                </svg>
                Average AQI
            </div>
            <div class="summary-card-value aqi-moderate">68</div>
            <div class="summary-card-description">Moderate air quality</div>
        </div>
        
        <div class="summary-card">
            <div class="summary-card-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                </svg>
                Alerts
            </div>
            <div class="summary-card-value">2</div>
            <div class="summary-card-description">Active air quality alerts</div>
        </div>
        
        <div class="summary-card">
            <div class="summary-card-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                    <line x1="9" y1="9" x2="9.01" y2="9"></line>
                    <line x1="15" y1="9" x2="15.01" y2="9"></line>
                </svg>
                Sensors
            </div>
            <div class="summary-card-value">{{ count($aqiData->pluck('sensor_id')->unique()) }}</div>
            <div class="summary-card-description">Active monitoring sensors</div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h2 class="card-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="9" y1="3" x2="9" y2="21"></line>
                </svg>
                AQI Readings
            </h2>
            <div class="table-actions">
                <button class="time-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                    Export Data
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Sensor Location</th>
                            <th>AQI Value</th>
                            <th>Health Impact</th>
                            <th>Recorded At</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($aqiData as $data)
                            @php
                                $aqiClass = 'aqi-good';
                                $healthImpact = 'Good';
                                
                                if($data->aqi_value > 50) {
                                    $aqiClass = 'aqi-moderate';
                                    $healthImpact = 'Moderate';
                                }
                                if($data->aqi_value > 100) {
                                    $aqiClass = 'aqi-unhealthy-sensitive';
                                    $healthImpact = 'Unhealthy for Sensitive Groups';
                                }
                                if($data->aqi_value > 150) {
                                    $aqiClass = 'aqi-unhealthy';
                                    $healthImpact = 'Unhealthy';
                                }
                            @endphp
                            <tr>
                                <td>
                                    <div class="font-medium">{{ $data->sensor->location }}</div>
                                    <div class="text-sm" style="color: var(--text-secondary)">ID: {{ $data->sensor->id }}</div>
                                </td>
                                <td>
                                    <span class="aqi-badge {{ $aqiClass }}">{{ $data->aqi_value }}</span>
                                </td>
                                <td>{{ $healthImpact }}</td>
                                <td>
                                    <div>{{ $data->recorded_at->format('M j, Y') }}</div>
                                    <div class="text-sm" style="color: var(--text-secondary)">{{ $data->recorded_at->format('H:i') }}</div>
                                </td>
                                <td>
                                    <a href="{{ route('aqi.show', $data->id) }}" class="time-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    // Simple time filter functionality
    document.querySelectorAll('.time-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.time-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Here you would typically make an AJAX call to filter data
            // For demo purposes we're just showing all data
        });
    });
</script>
@endsection