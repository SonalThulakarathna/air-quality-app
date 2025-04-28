@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <!-- Header Section with Glass Effect -->
    <div class="header-section mb-4">
        <div class="header-content px-4 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="text-light d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2 text-danger">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg>
                    Active Alerts
                </h2>
                <div class="d-flex align-items-center gap-3">
                    <div class="search-container">
                        <input type="text" class="search-input" placeholder="Search alerts...">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="search-icon">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-glass dropdown-toggle d-flex align-items-center" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                            </svg>
                            Filter
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="filterDropdown">
                            <li><a class="dropdown-item active" href="#">All Alerts</a></li>
                            <li><a class="dropdown-item" href="#">Critical</a></li>
                            <li><a class="dropdown-item" href="#">Warning</a></li>
                            <li><a class="dropdown-item" href="#">Information</a></li>
                        </ul>
                    </div>
                    <button class="btn btn-primary d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                            <polyline points="1 4 1 10 7 10"></polyline>
                            <polyline points="23 20 23 14 17 14"></polyline>
                            <path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path>
                        </svg>
                        Refresh
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="px-4">
        <div class="row">
            <!-- Left Sidebar with Stats -->
            <div class="col-lg-3 mb-4">
                <div class="sidebar-container">
                    @if($alerts->count() > 0)
                        <div class="alert-stats-card mb-4">
                            <div class="alert-stats-header">
                                <h5 class="mb-0">Alert Statistics</h5>
                            </div>
                            <div class="alert-stats-body">
                                <div class="alert-stat-item">
                                    <div class="alert-stat-icon bg-danger-glow">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="12" y1="8" x2="12" y2="12"></line>
                                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                        </svg>
                                    </div>
                                    <div class="alert-stat-content">
                                        <h3 class="mb-0">{{ $alerts->count() }}</h3>
                                        <p class="mb-0">Active Alerts</p>
                                    </div>
                                </div>
                                <div class="alert-stat-item">
                                    <div class="alert-stat-icon bg-warning-glow">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                            <line x1="12" y1="9" x2="12" y2="13"></line>
                                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                        </svg>
                                    </div>
                                    <div class="alert-stat-content">
                                        <h3 class="mb-0">{{ $alerts->where('priority', 'high')->count() }}</h3>
                                        <p class="mb-0">Critical</p>
                                    </div>
                                </div>
                                <div class="alert-stat-item">
                                    <div class="alert-stat-icon bg-info-glow">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="12" y1="16" x2="12" y2="12"></line>
                                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                        </svg>
                                    </div>
                                    <div class="alert-stat-content">
                                        <h3 class="mb-0">{{ $alerts->where('priority', 'medium')->count() }}</h3>
                                        <p class="mb-0">Warning</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="quick-actions-card">
                            <div class="quick-actions-header">
                                <h5 class="mb-0">Quick Actions</h5>
                            </div>
                            <div class="quick-actions-body">
                                <button class="btn btn-action btn-danger-soft w-100 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                        <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                        <polyline points="7 3 7 8 15 8"></polyline>
                                    </svg>
                                    Export Report
                                </button>
                                <button class="btn btn-action btn-primary-soft w-100 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="17 8 12 3 7 8"></polyline>
                                        <line x1="12" y1="3" x2="12" y2="15"></line>
                                    </svg>
                                    Notify Team
                                </button>
                                <button class="btn btn-action btn-success-soft w-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                    </svg>
                                    Resolve All
                                </button>
                            </div>
                        </div>
                    @else
                        <div class="no-alerts-sidebar">
                            <div class="empty-state-icon bg-success-subtle text-success mx-auto mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                </svg>
                            </div>
                            <h5 class="text-success mb-2">All Clear</h5>
                            <p class="text-muted mb-3">No active alerts detected</p>
                            <button class="btn btn-action btn-success-soft w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="16" x2="12" y2="12"></line>
                                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                </svg>
                                View Alert History
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Main Alert Content -->
            <div class="col-lg-9">
                @if($alerts->count() > 0)
                    <div class="alerts-container">
                        @foreach($alerts as $alert)
                            <div class="alert-card mb-4">
                                <div class="alert-card-left">
                                    <div class="alert-priority-indicator priority-high"></div>
                                </div>
                                <div class="alert-card-content">
                                    <div class="alert-card-header">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <div class="alert-icon bg-danger-glow me-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <circle cx="12" cy="12" r="10"></circle>
                                                        <line x1="12" y1="8" x2="12" y2="12"></line>
                                                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <h5 class="mb-0 text-danger">{{ $alert->sensor->name }}</h5>
                                                    <div class="alert-meta">
                                                        <span class="alert-time">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <polyline points="12 6 12 12 16 14"></polyline>
                                                            </svg>
                                                            {{ $alert->created_at->diffForHumans() }}
                                                        </span>
                                                        <span class="alert-location">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                                <circle cx="12" cy="10" r="3"></circle>
                                                            </svg>
                                                            {{ $alert->sensor->location }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alert-status">
                                                <span class="badge bg-danger-glow">Active</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="alert-card-body">
                                        <p class="alert-message">{{ $alert->message }}</p>
                                        <div class="alert-details">
                                            <div class="alert-detail-item">
                                                <span class="detail-label">Sensor ID:</span>
                                                <span class="detail-value">{{ $alert->sensor->id }}</span>
                                            </div>
                                            <div class="alert-detail-item">
                                                <span class="detail-label">Alert Type:</span>
                                                <span class="detail-value">{{ $alert->type ?? 'System Alert' }}</span>
                                            </div>
                                            <div class="alert-detail-item">
                                                <span class="detail-label">Reading:</span>
                                                <span class="detail-value">{{ $alert->reading ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="alert-card-footer">
                                        <button class="btn btn-sm btn-light-soft">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                            Details
                                        </button>
                                        <button class="btn btn-sm btn-light-soft">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                <circle cx="12" cy="10" r="3"></circle>
                                            </svg>
                                            View Location
                                        </button>
                                        <button class="btn btn-sm btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                            </svg>
                                            Resolve
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state-container">
                        <div class="empty-state-content">
                            <div class="empty-state-icon bg-success-glow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                </svg>
                            </div>
                            <h3 class="text-success mb-3">All Systems Operational</h3>
                            <p class="text-muted mb-4">There are currently no active alerts in the system. All sensors are reporting normal readings.</p>
                            <div class="empty-state-actions">
                                <button class="btn btn-success me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="16" x2="12" y2="12"></line>
                                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                    </svg>
                                    View Alert History
                                </button>
                                <button class="btn btn-outline-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                    View Sensor Map
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
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
    
    /* Modern Header with Glass Effect */
    .header-section {
        background: linear-gradient(90deg, rgba(20, 20, 20, 0.9) 0%, rgba(30, 30, 30, 0.8) 100%);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        position: sticky;
        top: 0;
        z-index: 100;
    }
    
    .header-content {
        max-width: 1920px;
        margin: 0 auto;
    }
    
    /* Modern Search Input */
    .search-container {
        position: relative;
        width: 250px;
    }
    
    .search-input {
        background-color: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 50px;
        color: #e0e0e0;
        padding: 0.5rem 1rem 0.5rem 2.5rem;
        width: 100%;
        transition: all 0.3s ease;
    }
    
    .search-input:focus {
        background-color: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.2);
        box-shadow: 0 0 0 3px rgba(62, 166, 255, 0.15);
        outline: none;
    }
    
    .search-icon {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #9e9e9e;
    }
    
    /* Glass Button */
    .btn-glass {
        background-color: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #e0e0e0;
    }
    
    .btn-glass:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: #ffffff;
    }
    
    /* Sidebar Styling */
    .sidebar-container {
        position: sticky;
        top: 80px;
    }
    
    .alert-stats-card, .quick-actions-card, .no-alerts-sidebar {
        background-color: #141414;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }
    
    .alert-stats-header, .quick-actions-header {
        background-color: rgba(255, 255, 255, 0.02);
        padding: 1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }
    
    .alert-stats-body, .quick-actions-body {
        padding: 1rem;
    }
    
    .alert-stat-item {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }
    
    .alert-stat-item:last-child {
        margin-bottom: 0;
    }
    
    .alert-stat-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
    }
    
    .alert-stat-content h3 {
        font-size: 1.5rem;
        font-weight: 600;
    }
    
    .alert-stat-content p {
        color: #9e9e9e;
        font-size: 0.875rem;
    }
    
    /* Soft Buttons */
    .btn-action {
        border-radius: 12px;
        padding: 0.75rem 1rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn-danger-soft {
        background-color: rgba(255, 78, 69, 0.1);
        color: #ff4e45;
        border: none;
    }
    
    .btn-danger-soft:hover {
        background-color: rgba(255, 78, 69, 0.2);
        color: #ff4e45;
    }
    
    .btn-primary-soft {
        background-color: rgba(62, 166, 255, 0.1);
        color: #3ea6ff;
        border: none;
    }
    
    .btn-primary-soft:hover {
        background-color: rgba(62, 166, 255, 0.2);
        color: #3ea6ff;
    }
    
    .btn-success-soft {
        background-color: rgba(43, 166, 64, 0.1);
        color: #2ba640;
        border: none;
    }
    
    .btn-success-soft:hover {
        background-color: rgba(43, 166, 64, 0.2);
        color: #2ba640;
    }
    
    .btn-light-soft {
        background-color: rgba(255, 255, 255, 0.05);
        color: #e0e0e0;
        border: none;
    }
    
    .btn-light-soft:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: #ffffff;
    }
    
    /* Modern Alert Cards */
    .alert-card {
        display: flex;
        background-color: #141414;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    
    .alert-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
    }
    
    .alert-card-left {
        width: 8px;
        flex-shrink: 0;
    }
    
    .alert-priority-indicator {
        height: 100%;
        width: 100%;
    }
    
    .priority-high {
        background: linear-gradient(to bottom, #ff4e45, #ff7a45);
    }
    
    .priority-medium {
        background: linear-gradient(to bottom, #ffbb33, #ffd133);
    }
    
    .priority-low {
        background: linear-gradient(to bottom, #3ea6ff, #33d6ff);
    }
    
    .alert-card-content {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    
    .alert-card-header {
        padding: 1.25rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }
    
    .alert-meta {
        display: flex;
        gap: 1rem;
        margin-top: 0.25rem;
        color: #9e9e9e;
        font-size: 0.8125rem;
    }
    
    .alert-time, .alert-location {
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }
    
    .alert-card-body {
        padding: 1.25rem;
        flex-grow: 1;
    }
    
    .alert-message {
        margin-bottom: 1rem;
        font-size: 0.9375rem;
        line-height: 1.5;
    }
    
    .alert-details {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        background-color: rgba(0, 0, 0, 0.2);
        padding: 0.75rem;
        border-radius: 8px;
    }
    
    .alert-detail-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .detail-label {
        color: #9e9e9e;
        font-size: 0.8125rem;
    }
    
    .detail-value {
        font-weight: 500;
        font-size: 0.8125rem;
    }
    
    .alert-card-footer {
        padding: 1rem 1.25rem;
        background-color: rgba(0, 0, 0, 0.1);
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 0.75rem;
    }
    
    /* Glowing Effects */
    .bg-danger-glow {
        background-color: rgba(255, 78, 69, 0.15);
        box-shadow: 0 0 15px rgba(255, 78, 69, 0.3);
        color: #ff4e45;
    }
    
    .bg-warning-glow {
        background-color: rgba(255, 187, 51, 0.15);
        box-shadow: 0 0 15px rgba(255, 187, 51, 0.3);
        color: #ffbb33;
    }
    
    .bg-info-glow {
        background-color: rgba(62, 166, 255, 0.15);
        box-shadow: 0 0 15px rgba(62, 166, 255, 0.3);
        color: #3ea6ff;
    }
    
    .bg-success-glow {
        background-color: rgba(43, 166, 64, 0.15);
        box-shadow: 0 0 15px rgba(43, 166, 64, 0.3);
        color: #2ba640;
    }
    
    /* Badge Styling */
    .badge {
        padding: 0.4em 0.8em;
        font-weight: 500;
        border-radius: 50px;
    }
    
    /* Empty State */
    .empty-state-container {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 400px;
    }
    
    .empty-state-content {
        text-align: center;
        max-width: 500px;
    }
    
    .empty-state-icon {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 2rem;
    }
    
    .no-alerts-sidebar {
        padding: 2rem 1rem;
        text-align: center;
    }
    
    /* Primary Button */
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
    
    /* Responsive Adjustments */
    @media (max-width: 991.98px) {
        .sidebar-container {
            position: static;
            margin-bottom: 2rem;
        }
        
        .alert-details {
            flex-direction: column;
            gap: 0.5rem;
        }
    }
</style>
@endsection