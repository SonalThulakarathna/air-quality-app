@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card bg-dark border-0 shadow-lg">
                <div class="card-header bg-gradient-primary-to-secondary">
                    <h2 class="h4 text-white mb-0">Register New Sensor</h2>
                </div>
                
                <div class="card-body px-5 py-4">
                    <form action="{{ route('sensors.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        
                        <div class="mb-4">
                            <label for="name" class="form-label text-light">Sensor Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark border-secondary text-light">
                                    <i class="fas fa-sensor"></i>
                                </span>
                                <input type="text" 
                                       class="form-control bg-dark text-light border-secondary" 
                                       id="name" 
                                       name="name" 
                                       placeholder="e.g. Main Building Sensor" 
                                       required>
                                <div class="invalid-feedback">
                                    Please provide a sensor name.
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="sensor_id" class="form-label text-light">Sensor ID</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark border-secondary text-light">
                                    <i class="fas fa-id-card"></i>
                                </span>
                                <input type="text" 
                                       class="form-control bg-dark text-light border-secondary" 
                                       id="sensor_id" 
                                       name="sensor_id" 
                                       placeholder="e.g. SENSOR-001" 
                                       required>
                                <div class="invalid-feedback">
                                    Please provide a unique sensor ID.
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="location_description" class="form-label text-light">Location Description</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark border-secondary text-light">
                                    <i class="fas fa-map-marker-alt"></i>
                                </span>
                                <input type="text" 
                                       class="form-control bg-dark text-light border-secondary" 
                                       id="location_description" 
                                       name="location_description" 
                                       placeholder="e.g. Main Building, Floor 3">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="latitude" class="form-label text-light">Latitude</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark border-secondary text-light">
                                        <i class="fas fa-globe"></i>
                                    </span>
                                    <input type="text" 
                                           class="form-control bg-dark text-light border-secondary" 
                                           id="latitude" 
                                           name="latitude" 
                                           placeholder="e.g. 40.7128" 
                                           pattern="-?\d{1,3}\.\d+" 
                                           required>
                                    <div class="invalid-feedback">
                                        Please provide a valid latitude (e.g. 40.7128).
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <label for="longitude" class="form-label text-light">Longitude</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark border-secondary text-light">
                                        <i class="fas fa-globe"></i>
                                    </span>
                                    <input type="text" 
                                           class="form-control bg-dark text-light border-secondary" 
                                           id="longitude" 
                                           name="longitude" 
                                           placeholder="e.g. -74.0060" 
                                           pattern="-?\d{1,3}\.\d+" 
                                           required>
                                    <div class="invalid-feedback">
                                        Please provide a valid longitude (e.g. -74.0060).
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="installed_by" class="form-label text-light">Installed By</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark border-secondary text-light">
                                    <i class="fas fa-user"></i>
                                </span>
                                <select class="form-select bg-dark text-light border-secondary" 
                                        id="installed_by" 
                                        name="installed_by" 
                                        required>
                                    <option value="">Select User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Please select the user who installed the sensor.
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top border-secondary">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-light">
                                <i class="fas fa-arrow-left me-2"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-2"></i> Save Sensor
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="text-center mt-4 text-muted">
                <small>Ensure all sensor details are accurate before submission.</small>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #121212;
        color: #e0e0e0;
    }
    
    .bg-gradient-primary-to-secondary {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    }
    
    .card {
        border-radius: 0.5rem;
        overflow: hidden;
    }
    
    .form-control:focus, .form-select:focus {
        background-color: #1e1e1e;
        color: #ffffff;
        border-color: #2575fc;
        box-shadow: 0 0 0 0.25rem rgba(37, 117, 252, 0.25);
    }
    
    .btn-primary {
        background-color: #2575fc;
        border-color: #2575fc;
    }
    
    .btn-primary:hover {
        background-color: #1a65e0;
        border-color: #1a65e0;
    }
    
    .btn-outline-light:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }
</style>

<script>
// Example client-side validation
(function () {
    'use strict'
    
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')
    
    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                
                form.classList.add('was-validated')
            }, false)
        })
})()
</script>
@endsection