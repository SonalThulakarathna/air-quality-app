@extends('layouts.app')

@section('styles')
<style>
    :root {
        --bg-primary: #121212;
        --bg-secondary: #1e1e1e;
        --bg-tertiary: #252525;
        --bg-card: #2d2d2d;
        --text-primary: #ffffff;
        --text-secondary: #b0b0b0;
        --text-tertiary: #808080;
        --border-color: #3a3a3a;
        --accent-blue: #4dabf7;
        --accent-green: #51cf66;
        --accent-yellow: #fcc419;
        --accent-red: #ff6b6b;
        --accent-purple: #9775fa;
    }

    body {
        background-color: var(--bg-primary);
        color: var(--text-primary);
    }

    .sensors-container {
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

    .search-box {
        position: relative;
        width: 320px;
    }

    .search-input {
        width: 100%;
        padding: 0.75rem 1.25rem 0.75rem 3rem;
        border-radius: 8px;
        border: 1px solid var(--border-color);
        background-color: var(--bg-secondary);
        color: var(--text-primary);
        font-size: 0.9375rem;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        outline: none;
        border-color: var(--accent-blue);
        box-shadow: 0 0 0 3px rgba(77, 171, 247, 0.2);
    }

    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-tertiary);
        pointer-events: none;
    }

    /* Card */
    .card {
        background-color: var(--bg-card);
        border-radius: 12px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        border: none;
    }

    .card-header {
        padding: 1.5rem 2rem;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: rgba(45, 45, 45, 0.8);
        backdrop-filter: blur(4px);
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
        min-width: 800px;
    }

    .data-table th {
        background-color: var(--bg-tertiary);
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

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.375rem 0.875rem;
        border-radius: 50px;
        font-size: 0.8125rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        gap: 0.5rem;
    }

    .status-badge:before {
        content: "";
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
    }

    .status-active {
        background-color: rgba(81, 207, 102, 0.15);
        color: var(--accent-green);
    }

    .status-active:before {
        background-color: var(--accent-green);
    }

    .status-inactive {
        background-color: rgba(255, 107, 107, 0.15);
        color: var(--accent-red);
    }

    .status-inactive:before {
        background-color: var(--accent-red);
    }

    .status-maintenance {
        background-color: rgba(252, 196, 25, 0.15);
        color: var(--accent-yellow);
    }

    .status-maintenance:before {
        background-color: var(--accent-yellow);
    }

    /* Buttons */
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.625rem;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-size: 0.9375rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
        text-decoration: none;
    }

    .btn-sm {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
    }

    .btn-icon {
        padding: 0.625rem;
        border-radius: 8px;
        width: 40px;
        height: 40px;
    }

    .btn-primary {
        background-color: var(--accent-blue);
        color: #ffffff;
    }

    .btn-primary:hover {
        background-color: #3d9ae8;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(77, 171, 247, 0.3);
    }

    .btn-outline {
        background-color: transparent;
        color: var(--accent-blue);
        border: 1px solid var(--accent-blue);
    }

    .btn-outline:hover {
        background-color: rgba(77, 171, 247, 0.1);
    }

    .btn-warning {
        background-color: var(--accent-yellow);
        color: #000000;
    }

    .btn-warning:hover {
        background-color: #e6b800;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(252, 196, 25, 0.3);
    }

    .btn-danger {
        background-color: var(--accent-red);
        color: #ffffff;
    }

    .btn-danger:hover {
        background-color: #e05550;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(255, 107, 107, 0.3);
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 0.75rem;
    }

    /* Empty State */
    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 4rem 2rem;
        text-align: center;
    }

    .empty-icon {
        color: var(--text-tertiary);
        margin-bottom: 1.5rem;
        opacity: 0.7;
    }

    .empty-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
        color: var(--text-primary);
    }

    .empty-description {
        color: var(--text-secondary);
        margin-bottom: 2rem;
        max-width: 500px;
        line-height: 1.6;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .sensors-container {
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
        }
        
        .search-box {
            width: 100%;
        }
        
        .card-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
            padding: 1.25rem;
        }
    }

    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .data-table tr {
        animation: fadeIn 0.3s ease forwards;
    }

    .data-table tr:nth-child(1) { animation-delay: 0.05s; }
    .data-table tr:nth-child(2) { animation-delay: 0.1s; }
    .data-table tr:nth-child(3) { animation-delay: 0.15s; }
    .data-table tr:nth-child(4) { animation-delay: 0.2s; }
    .data-table tr:nth-child(5) { animation-delay: 0.25s; }
</style>
@endsection

@section('content')
<div class="sensors-container">
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-microchip"></i>
            Sensors
        </h1>
        <div class="header-actions">
            <div class="search-box">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-input" placeholder="Search sensors...">
            </div>
            <a href="{{ route('sensors.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Add Sensor
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h2 class="card-title">
                <i class="fas fa-list"></i>
                Sensor List
            </h2>
        </div>
        <div class="card-body">
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Sensor ID</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Installed By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sensors as $sensor)
                            <tr>
                                <td>{{ $sensor->name }}</td>
                                <td>{{ $sensor->sensor_id }}</td>
                                <td>
                                    {{ $sensor->location_description }}
                                    <div class="text-muted">
                                        {{ $sensor->latitude }}, {{ $sensor->longitude }}
                                    </div>
                                </td>
                                <td>
                                    <span class="status-badge {{ $sensor->is_active ? 'status-active' : 'status-inactive' }}">
                                        {{ $sensor->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>{{ $sensor->installer->name ?? 'Unknown' }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('sensors.edit', $sensor) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('sensors.destroy', $sensor) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this sensor?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No sensors found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Add any JavaScript for the sensors page here
</script>
@endsection