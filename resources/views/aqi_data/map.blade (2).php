@extends('layouts.app')

@section('styles')
<style>
    .map-container {
        height: 100%;
        width: 100%;
    }

    #sensorMap {
        height: 100%;
        width: 100%;
    }

    /* Custom Leaflet Map Styling */
    .leaflet-container {
        background-color: #1a1a1a !important;
    }

    .leaflet-control-zoom a {
        background-color: var(--bg-secondary) !important;
        color: var(--text-primary) !important;
        border-color: var(--border-color) !important;
    }

    .leaflet-control-zoom a:hover {
        background-color: var(--bg-tertiary) !important;
    }

    .leaflet-popup-content-wrapper {
        background-color: var(--bg-secondary);
        color: var(--text-primary);
        border-radius: 8px;
    }

    .leaflet-popup-tip {
        background-color: var(--bg-secondary);
    }

    .aqi-popup {
        padding: 0.5rem;
    }

    .aqi-popup-title {
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .aqi-value {
        display: inline-block;
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-weight: 600;
    }

    .aqi-good {
        background-color: rgba(43, 166, 64, 0.2);
        color: var(--accent-green);
    }

    .aqi-moderate {
        background-color: rgba(255, 214, 0, 0.2);
        color: var(--accent-yellow);
    }

    .aqi-unhealthy {
        background-color: rgba(255, 78, 69, 0.2);
        color: var(--accent-red);
    }
</style>
@endsection

@section('content')
<div class="map-container">
    <div id="sensorMap"></div>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize map with dark theme
        var map = L.map('sensorMap').setView([6.9271, 79.8612], 12); // Colombo Coordinates

        // Custom dark theme map tiles
        L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
            subdomains: 'abcd',
            maxZoom: 19
        }).addTo(map);

        // Function to determine AQI class
        function getAqiClass(value) {
            if (value <= 50) return 'aqi-good';
            if (value <= 100) return 'aqi-moderate';
            return 'aqi-unhealthy';
        }

        // Function to create custom popup content
        function createPopupContent(sensor, aqiValue) {
            var aqiClass = getAqiClass(aqiValue);
            var content = `
                <div class="aqi-popup">
                    <div class="aqi-popup-title">${sensor.location}</div>
                    <div>AQI: <span class="${aqiClass}">${aqiValue}</span></div>
                </div>
            `;
            return content;
        }

        // Custom marker icon
        var sensorIcon = L.divIcon({
            className: 'sensor-marker',
            html: `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#3ea6ff" stroke="#0f0f0f" stroke-width="2">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                    <circle cx="12" cy="10" r="3"></circle>
                  </svg>`,
            iconSize: [24, 24],
            iconAnchor: [12, 24],
            popupAnchor: [0, -24]
        });

        // Add markers for each sensor
        @if(count($sensors) > 0)
            @foreach ($sensors as $sensor)
                @php
                    $latestAqi = $sensor->aqiData->last();  // Get the latest AQI data
                    $aqiValue = $latestAqi ? $latestAqi->aqi_value : 'N/A';  // Set a default message if no data
                @endphp

                var marker = L.marker([{{ $sensor->latitude }}, {{ $sensor->longitude }}], {
                    icon: sensorIcon
                }).addTo(map);
                
                marker.bindPopup(createPopupContent({
                    location: "{{ $sensor->location }}"
                }, "{{ $aqiValue }}"));
            @endforeach
        @else
            console.error("No sensor data available.");
        @endif

        // Resize map when window is resized
        window.addEventListener('resize', function() {
            map.invalidateSize();
        });
    });
</script>
@endsection

