@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css" />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    :root {
        --bg-primary: #0a0a0a;
        --bg-secondary: #141414;
        --bg-tertiary: #1e1e1e;
        --text-primary: #ffffff;
        --text-secondary: #b3b3b3;
        --text-tertiary: #808080;
        --accent-blue: #3ea6ff;
        --accent-red: #ff4e45;
        --accent-green: #2ba640;
        --accent-yellow: #ffd600;
        --accent-orange: #ff922b;
        --accent-purple: #9775fa;
        --border-color: #2a2a2a;
        --sidebar-width: 280px;
        --header-height: 70px;
        --transition-speed: 0.3s;
        --card-border-radius: 12px;
        --button-border-radius: 8px;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background-color: var(--bg-primary);
        color: var(--text-primary);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        overflow: hidden;
        height: 100vh;
        width: 100vw;
        line-height: 1.5;
    }

    /* Layout Structure */
    .app-container {
        display: flex;
        flex-direction: column;
        height: 100vh;
        width: 100vw;
    }

    /* Header Styles */
    .app-header {
        height: var(--header-height);
        background-color: var(--bg-secondary);
        border-bottom: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 2rem;
        z-index: 100;
        position: relative;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .header-title {
        font-size: 1.5rem;
        font-weight: 700;
        background: linear-gradient(90deg, var(--accent-blue), var(--accent-purple));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        letter-spacing: -0.02em;
    }

    .header-actions {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .date-display {
        font-size: 0.9375rem;
        color: var(--text-secondary);
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.5rem 0.75rem;
        background-color: var(--bg-tertiary);
        border-radius: var(--button-border-radius);
        border: 1px solid var(--border-color);
    }

    .user-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--accent-blue), var(--accent-purple));
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 1rem;
        color: white;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    .user-avatar:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    }

    .menu-toggle {
        display: none;
        background: none;
        border: none;
        color: var(--text-primary);
        cursor: pointer;
        padding: 0.75rem;
        border-radius: var(--button-border-radius);
        transition: background-color 0.2s ease;
    }

    .menu-toggle:hover {
        background-color: var(--bg-tertiary);
    }

    /* Main Content Area */
    .app-content {
        display: flex;
        flex: 1;
        overflow: hidden;
        position: relative;
    }

    /* Sidebar Styles */
    .sidebar {
        width: var(--sidebar-width);
        height: 100vh;
        background-color: var(--bg-secondary);
        border-right: 1px solid var(--border-color);
        display: flex;
        flex-direction: column;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
        overflow-y: auto;
        transition: transform var(--transition-speed) ease, box-shadow var(--transition-speed) ease;
        transform: translateX(0);
        padding-top: var(--header-height);
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
    }

    .sidebar-header {
        padding: 1.75rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        border-bottom: 1px solid var(--border-color);
    }

    .logo-icon {
        color: var(--accent-blue);
        width: 28px;
        height: 28px;
    }

    .logo-text {
        font-size: 1.5rem;
        font-weight: 700;
        background: linear-gradient(90deg, var(--accent-blue), var(--accent-purple));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        letter-spacing: -0.02em;
    }

    .user-profile {
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        border-bottom: 1px solid var(--border-color);
        background-color: rgba(255, 255, 255, 0.02);
    }

    .user-info {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .user-name {
        font-size: 1rem;
        font-weight: 600;
    }

    .user-role {
        font-size: 0.8125rem;
        color: var(--text-secondary);
    }

    .sidebar-nav {
        flex: 1;
        padding: 1.25rem 0;
    }

    .nav-item {
        list-style: none;
        margin-bottom: 0.5rem;
        padding: 0 0.75rem;
    }

    .nav-link {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.875rem 1.25rem;
        color: var(--text-primary);
        text-decoration: none;
        transition: all 0.2s ease;
        position: relative;
        border-radius: var(--button-border-radius);
    }

    .nav-link:hover {
        background-color: var(--bg-tertiary);
        transform: translateX(2px);
    }

    .nav-link.active {
        background: linear-gradient(90deg, rgba(62, 166, 255, 0.15), transparent);
        color: var(--accent-blue);
    }

    .nav-link.active::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: linear-gradient(to bottom, var(--accent-blue), var(--accent-purple));
        border-radius: 0 4px 4px 0;
    }

    .nav-icon {
        width: 20px;
        height: 20px;
        color: var(--text-secondary);
        transition: color 0.2s ease;
    }

    .nav-link.active .nav-icon {
        color: var(--accent-blue);
    }

    .nav-link span {
        flex: 1;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 22px;
        height: 22px;
        padding: 0 6px;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 11px;
        background-color: var(--accent-red);
        color: white;
    }

    .sidebar-footer {
        padding: 1.5rem;
        border-top: 1px solid var(--border-color);
    }

    .logout-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        width: 100%;
        padding: 0.875rem;
        background-color: var(--bg-tertiary);
        border: 1px solid var(--border-color);
        border-radius: var(--button-border-radius);
        color: var(--text-primary);
        font-size: 0.9375rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .logout-btn:hover {
        background-color: rgba(255, 78, 69, 0.15);
        border-color: var(--accent-red);
        color: var(--accent-red);
    }

    /* Map Container */
    .map-container {
        flex: 1;
        height: calc(100vh - var(--header-height));
        margin-left: var(--sidebar-width);
        position: relative;
        transition: margin-left var(--transition-speed) ease;
    }

    #sensorMap {
        width: 100%;
        height: 100%;
    }

    /* Map Controls */
    .map-controls {
        position: absolute;
        top: 1.5rem;
        right: 1.5rem;
        z-index: 1000;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .map-control-btn {
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--bg-secondary);
        border: 1px solid var(--border-color);
        border-radius: var(--button-border-radius);
        color: var(--text-primary);
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .map-control-btn:hover {
        background-color: var(--bg-tertiary);
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
    }

    .map-control-btn.active {
        background-color: var(--accent-blue);
        color: white;
        border-color: var(--accent-blue);
    }

    /* Custom Leaflet Map Styling */
    .leaflet-container {
        background-color: var(--bg-primary) !important;
    }

    .leaflet-control-zoom {
        margin-top: 80px !important;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2) !important;
        border-radius: var(--button-border-radius) !important;
        overflow: hidden;
    }

    .leaflet-control-zoom a {
        background-color: var(--bg-secondary) !important;
        color: var(--text-primary) !important;
        border-color: var(--border-color) !important;
        width: 36px !important;
        height: 36px !important;
        line-height: 36px !important;
        font-size: 18px !important;
    }

    .leaflet-control-zoom a:hover {
        background-color: var(--bg-tertiary) !important;
    }

    .leaflet-popup-content-wrapper {
        background-color: var(--bg-secondary);
        color: var(--text-primary);
        border-radius: var(--card-border-radius);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
        border: 1px solid var(--border-color);
    }

    .leaflet-popup-tip {
        background-color: var(--bg-secondary);
        border: 1px solid var(--border-color);
    }

    .aqi-popup {
        padding: 1.25rem;
        min-width: 240px;
    }

    .aqi-popup-title {
        font-weight: 600;
        margin-bottom: 0.75rem;
        font-size: 1.125rem;
        color: var(--accent-blue);
    }

    .aqi-value {
        display: inline-block;
        padding: 0.375rem 0.75rem;
        border-radius: 6px;
        font-weight: 700;
        font-size: 1.125rem;
        margin: 0.25rem 0;
    }

    .aqi-good {
        background-color: rgba(43, 166, 64, 0.2);
        color: var(--accent-green);
    }

    .aqi-moderate {
        background-color: rgba(255, 214, 0, 0.2);
        color: var(--accent-yellow);
    }

    .aqi-unhealthy-sensitive {
        background-color: rgba(255, 146, 43, 0.2);
        color: var(--accent-orange);
    }

    .aqi-unhealthy {
        background-color: rgba(255, 78, 69, 0.2);
        color: var(--accent-red);
    }

    .aqi-hazardous {
        background-color: rgba(153, 0, 0, 0.2);
        color: #ff0000;
    }

    .aqi-details {
        margin-top: 0.75rem;
        font-size: 0.875rem;
        color: var(--text-secondary);
    }

    .aqi-details-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.5rem;
    }

    .aqi-details-label {
        font-weight: 500;
    }

    /* Cluster Marker Styling */
    .marker-cluster-custom {
        background-color: rgba(62, 166, 255, 0.2);
        border: 2px solid rgba(62, 166, 255, 0.3);
    }

    .marker-cluster-custom div {
        background-color: rgba(62, 166, 255, 0.6);
        color: white;
        font-weight: 600;
    }

    /* Legend Control */
    .info.legend {
        background: var(--bg-secondary);
        padding: 1.25rem;
        border-radius: var(--card-border-radius);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.3);
        border: 1px solid var(--border-color);
        color: var(--text-primary);
        margin-bottom: 20px !important;
    }

    .legend-title {
        font-weight: 600;
        margin-bottom: 0.75rem;
        font-size: 0.9375rem;
    }

    .legend-scale {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.875rem;
    }

    .legend-color {
        width: 16px;
        height: 16px;
        border-radius: 4px;
    }

    /* Responsive adjustments */
    @media (max-width: 1024px) {
        :root {
            --sidebar-width: 240px;
        }
    }

    @media (max-width: 768px) {
        .menu-toggle {
            display: flex;
        }

        .sidebar {
            transform: translateX(-100%);
            box-shadow: none;
        }

        .sidebar.open {
            transform: translateX(0);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
        }

        .map-container {
            margin-left: 0;
        }

        .overlay {
            display: none;
            position: fixed;
            top: var(--header-height);
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 999;
            backdrop-filter: blur(4px);
        }

        .overlay.active {
            display: block;
        }
    }

    /* Animation */
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    .pulse {
        animation: pulse 2s infinite;
    }

    /* Scrollbar styling */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: var(--bg-secondary);
    }

    ::-webkit-scrollbar-thumb {
        background: var(--bg-tertiary);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: var(--border-color);
    }
</style>
@endsection

@section('content')
<div class="app-container">
    <!-- Header -->
    <header class="app-header">
        <div class="header-title">AQI Simulation</div>
        <div class="header-actions">
            <button class="menu-toggle" id="menu-toggle">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
            <div class="date-display">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                <span>{{ now()->format('l, F j, Y') }}</span>
            </div>
            <div class="user-avatar" title="{{ auth()->user()->name ?? 'Admin' }}">
                {{ substr(auth()->user()->name ?? 'Admin', 0, 1) }}
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="app-content">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <svg xmlns="http://www.w3.org/2000/svg" class="logo-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                </svg>
                <span class="logo-text">AQI Simulation</span>
            </div>

            <div class="user-profile">
                <div class="user-avatar">
                    {{ substr(auth()->user()->name ?? 'Admin', 0, 1) }}
                </div>
                <div class="user-info">
                    <div class="user-name">{{ auth()->user()->name ?? 'Admin' }}</div>
                    <div class="user-role">System Administrator</div>
                </div>
            </div>

            <nav class="sidebar-nav">
                <ul>
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" class="nav-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <svg xmlns="http://www.w3.org/2000/svg" class="nav-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <span>AQI Map</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('alerts.index') }}" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" class="nav-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                            </svg>
                            <span>Alerts</span>
                            <div class="badge">3</div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dashboard.overview') }}" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" class="nav-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="20" x2="12" y2="10"></line>
                                <line x1="18" y1="20" x2="18" y2="4"></line>
                                <line x1="6" y1="20" x2="6" y2="16"></line>
                            </svg>
                            <span>AQI Analytics</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('sensors.index') }}" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" class="nav-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                                <path d="M12 5v14"></path>
                                <circle cx="12" cy="12" r="10"></circle>
                            </svg>
                            <span>Sensor Management</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="sidebar-footer">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Map Container -->
        <div class="map-container">
            <div id="sensorMap"></div>
            
            <!-- Map Controls -->
            <div class="map-controls">
                <button class="map-control-btn" id="locate-btn" title="Locate me">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                </button>
                <button class="map-control-btn" id="refresh-btn" title="Refresh data">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="23 4 23 10 17 10"></polyline>
                        <polyline points="1 20 1 14 7 14"></polyline>
                        <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
                    </svg>
                </button>
                <button class="map-control-btn active" id="markers-btn" title="Toggle markers">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                </button>
                <button class="map-control-btn" id="heatmap-btn" title="Toggle heatmap">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 9a2 2 0 0 1-2 2H6l-4 4V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2z"></path>
                        <path d="M18 9h2a2 2 0 0 1 2 2v11l-4-4h-6a2 2 0 0 1-2-2v-1"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Overlay -->
        <div class="overlay" id="overlay"></div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile menu toggle
        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        if (menuToggle && sidebar && overlay) {
            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('open');
                overlay.classList.toggle('active');
            });

            overlay.addEventListener('click', function() {
                sidebar.classList.remove('open');
                overlay.classList.remove('active');
            });
        }
        
        // Initialize map with dark theme
        var map = L.map('sensorMap', {
            zoomControl: false,
            preferCanvas: true
        }).setView([6.9271, 79.8612], 12); // Default to Colombo coordinates

        // Custom dark theme map tiles
        L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
            subdomains: 'abcd',
            maxZoom: 19
        }).addTo(map);

        // Add zoom control with custom position
        L.control.zoom({
            position: 'topright'
        }).addTo(map);

        // Function to determine AQI class and health impact
        function getAqiInfo(value) {
            if (value <= 50) return { 
                class: 'aqi-good',
                level: 'Good',
                health: 'Air quality is satisfactory with little to no risk'
            };
            if (value <= 100) return { 
                class: 'aqi-moderate',
                level: 'Moderate',
                health: 'Acceptable quality, but may affect sensitive individuals'
            };
            if (value <= 150) return { 
                class: 'aqi-unhealthy-sensitive',
                level: 'Unhealthy for Sensitive Groups',
                health: 'General public not likely affected but sensitive groups may experience health effects'
            };
            if (value <= 200) return { 
                class: 'aqi-unhealthy',
                level: 'Unhealthy',
                health: 'Everyone may begin to experience health effects'
            };
            if (value <= 300) return { 
                class: 'aqi-unhealthy',
                level: 'Very Unhealthy',
                health: 'Health warnings of emergency conditions'
            };
            return { 
                class: 'aqi-hazardous',
                level: 'Hazardous',
                health: 'Health alert: everyone may experience serious health effects'
            };
        }

        // Function to create custom popup content
        function createPopupContent(sensor, aqiValue, recordedAt) {
            var aqiInfo = getAqiInfo(aqiValue);
            var formattedDate = new Date(recordedAt).toLocaleString();
            
            var content = `
                <div class="aqi-popup">
                    <div class="aqi-popup-title">${sensor.location}</div>
                    <div class="aqi-details-row">
                        <span class="aqi-details-label">AQI:</span>
                        <span class="aqi-value ${aqiInfo.class}">${aqiValue} (${aqiInfo.level})</span>
                    </div>
                    <div class="aqi-details">
                        <div class="aqi-details-row">
                            <span class="aqi-details-label">Last Reading:</span>
                            <span>${formattedDate}</span>
                        </div>
                        <div class="aqi-details-row">
                            <span class="aqi-details-label">Coordinates:</span>
                            <span>${sensor.latitude.toFixed(4)}, ${sensor.longitude.toFixed(4)}</span>
                        </div>
                        <div class="aqi-details-row">
                            <span class="aqi-details-label">Health Impact:</span>
                            <span>${aqiInfo.health}</span>
                        </div>
                    </div>
                </div>
            `;
            return content;
        }

        // Custom marker icons based on AQI level
        function createMarkerIcon(aqiValue) {
            var aqiInfo = getAqiInfo(aqiValue);
            var iconColor;
            
            switch(aqiInfo.class) {
                case 'aqi-good': iconColor = '#2ba640'; break;
                case 'aqi-moderate': iconColor = '#ffd600'; break;
                case 'aqi-unhealthy-sensitive': iconColor = '#ff922b'; break;
                case 'aqi-unhealthy': iconColor = '#ff4e45'; break;
                case 'aqi-hazardous': iconColor = '#990000'; break;
                default: iconColor = '#3ea6ff';
            }
            
            return L.divIcon({
                className: 'sensor-marker',
                html: `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="${iconColor}" stroke="#0f0f0f" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                      </svg>`,
                iconSize: [24, 24],
                iconAnchor: [12, 24],
                popupAnchor: [0, -24]
            });
        }

        // Create marker cluster group
        var markers = L.markerClusterGroup({
            iconCreateFunction: function(cluster) {
                var childMarkers = cluster.getAllChildMarkers();
                var totalAqi = 0;
                var maxAqi = 0;
                
                childMarkers.forEach(function(marker) {
                    totalAqi += marker.options.aqiValue;
                    if (marker.options.aqiValue > maxAqi) {
                        maxAqi = marker.options.aqiValue;
                    }
                });
                
                var avgAqi = Math.round(totalAqi / childMarkers.length);
                var aqiInfo = getAqiInfo(avgAqi);
                
                return L.divIcon({
                    html: `<div style="background-color: ${aqiInfo.class === 'aqi-good' ? 'rgba(43, 166, 64, 0.6)' : 
                                            aqiInfo.class === 'aqi-moderate' ? 'rgba(255, 214, 0, 0.6)' : 
                                            aqiInfo.class === 'aqi-unhealthy-sensitive' ? 'rgba(255, 146, 43, 0.6)' : 
                                            aqiInfo.class === 'aqi-unhealthy' ? 'rgba(255, 78, 69, 0.6)' : 
                                            'rgba(153, 0, 0, 0.6)'};
                            width: 40px; 
                            height: 40px; 
                            border-radius: 50%; 
                            display: flex; 
                            align-items: center; 
                            justify-content: center; 
                            color: white; 
                            font-weight: bold;
                            border: 2px solid white;">
                            ${cluster.getChildCount()}
                          </div>`,
                    className: 'marker-cluster-custom',
                    iconSize: L.point(40, 40)
                });
            },
            spiderfyOnMaxZoom: true,
            showCoverageOnHover: false,
            zoomToBoundsOnClick: true
        });

        // Add markers for each sensor
        @if(count($sensors) > 0)
            @foreach ($sensors as $sensor)
                @php
                    $latestAqi = $sensor->aqiData->last();
                    $aqiValue = $latestAqi ? $latestAqi->aqi_value : 0;
                    $recordedAt = $latestAqi ? $latestAqi->recorded_at : now();
                @endphp

                var marker = L.marker(
                    [{{ $sensor->latitude }}, {{ $sensor->longitude }}], 
                    {
                        icon: createMarkerIcon({{ $aqiValue }}),
                        aqiValue: {{ $aqiValue }},
                        riseOnHover: true
                    }
                );
                
                marker.bindPopup(createPopupContent(
                    {
                        location: "{{ $sensor->location }}",
                        latitude: {{ $sensor->latitude }},
                        longitude: {{ $sensor->longitude }}
                    }, 
                    {{ $aqiValue }}, 
                    "{{ $recordedAt }}"
                ));
                
                markers.addLayer(marker);
            @endforeach
        @else
            console.error("No sensor data available.");
        @endif

        // Add markers to map
        map.addLayer(markers);

        // Fit map to show all markers
        map.fitBounds(markers.getBounds(), { padding: [50, 50] });

        // Add legend
        var legend = L.control({ position: 'bottomright' });

        legend.onAdd = function(map) {
            var div = L.DomUtil.create('div', 'info legend');
            div.innerHTML = `
                <div class="legend-title">AQI Levels</div>
                <div class="legend-scale">
                    <div class="legend-item">
                        <span class="legend-color" style="background-color: rgba(43, 166, 64, 0.6)"></span>
                        <span>Good (0-50)</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-color" style="background-color: rgba(255, 214, 0, 0.6)"></span>
                        <span>Moderate (51-100)</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-color" style="background-color: rgba(255, 146, 43, 0.6)"></span>
                        <span>Unhealthy for SG (101-150)</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-color" style="background-color: rgba(255, 78, 69, 0.6)"></span>
                        <span>Unhealthy (151+)</span>
                    </div>
                </div>
            `;
            return div;
        };

        legend.addTo(map);

        // Locate button functionality
        document.getElementById('locate-btn').addEventListener('click', function() {
            map.locate({setView: true, maxZoom: 14});
        });

        // Refresh button functionality
        document.getElementById('refresh-btn').addEventListener('click', function() {
            // In a real app, this would fetch fresh data from the server
            window.location.reload();
        });

        // Toggle markers button functionality
        document.getElementById('markers-btn').addEventListener('click', function() {
            this.classList.toggle('active');
            if (this.classList.contains('active')) {
                map.addLayer(markers);
            } else {
                map.removeLayer(markers);
            }
        });

        // Heatmap button functionality (placeholder)
        document.getElementById('heatmap-btn').addEventListener('click', function() {
            this.classList.toggle('active');
            alert('Heatmap visualization would be implemented here');
        });

        // Handle location found
        map.on('locationfound', function(e) {
            L.circle(e.latlng, {
                color: 'var(--accent-blue)',
                fillColor: 'var(--accent-blue)',
                fillOpacity: 0.2,
                radius: e.accuracy / 2
            }).addTo(map).bindPopup("You are within " + Math.round(e.accuracy) + " meters from this point");
        });

        // Handle location error
        map.on('locationerror', function(e) {
            alert("Location access denied. Using default view.");
        });

        // Resize map when window is resized
        window.addEventListener('resize', function() {
            map.invalidateSize();
        });

        // Auto-refresh data every 5 minutes (300000 ms)
        setInterval(function() {
            // In a real app, this would fetch fresh data via AJAX
            console.log('Auto-refreshing data...');
        }, 300000);
    });
</script>
@endsection