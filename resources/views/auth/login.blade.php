@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card bg-dark border-0 shadow-lg">
                <div class="card-header bg-gradient-primary-to-secondary p-4">
                    <h2 class="h4 text-white mb-0 d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        Admin Login
                    </h2>
                </div>
                
                <div class="card-body px-4 py-5">
                    <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                        @csrf
                        
                        <div class="mb-4">
                            <label for="email" class="form-label text-light fw-medium mb-2">Email Address</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-dark border-secondary text-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg>
                                </span>
                                <input type="email" 
                                       class="form-control form-control-lg bg-dark text-light border-secondary @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       placeholder="your@email.com"
                                       required 
                                       autocomplete="email" 
                                       autofocus>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label for="password" class="form-label text-light fw-medium mb-0">Password</label>
                                @if (Route::has('password.request'))
                                    <a class="text-primary text-decoration-none small" href="{{ route('password.request') }}">
                                        Forgot Password?
                                    </a>
                                @endif
                            </div>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-dark border-secondary text-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                </span>
                                <input type="password" 
                                       class="form-control form-control-lg bg-dark text-light border-secondary @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password" 
                                       placeholder="••••••••"
                                       required 
                                       autocomplete="current-password">
                                <button class="btn btn-outline-secondary border-secondary text-light" type="button" id="togglePassword">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="eyeIcon">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </button>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label text-light" for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                                    <polyline points="10 17 15 12 10 7"></polyline>
                                    <line x1="15" y1="12" x2="3" y2="12"></line>
                                </svg>
                                Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <p class="text-light mb-0">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-primary fw-medium text-decoration-none">Register here</a>
                </p>
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
    
    .bg-gradient-primary-to-secondary {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        border-bottom: none;
    }
    
    .card {
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    }
    
    .form-control, .form-select {
        padding: 0.75rem 1rem;
        font-size: 1rem;
        transition: all 0.2s ease;
    }
    
    .form-control:focus, .form-select:focus {
        background-color: #1e1e1e;
        color: #ffffff;
        border-color: #2575fc;
        box-shadow: 0 0 0 0.25rem rgba(37, 117, 252, 0.25);
    }
    
    .input-group-text {
        padding: 0.75rem 1rem;
    }
    
    .btn {
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #2575fc 0%, #6a11cb 100%);
        border: none;
        box-shadow: 0 4px 15px rgba(37, 117, 252, 0.4);
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(37, 117, 252, 0.5);
    }
    
    .form-check-input {
        width: 1.2em;
        height: 1.2em;
        margin-top: 0.15em;
        background-color: #1e1e1e;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .form-check-input:checked {
        background-color: #2575fc;
        border-color: #2575fc;
    }
    
    .form-check-label {
        padding-left: 0.25rem;
    }
    
    .form-label {
        font-size: 0.95rem;
        margin-left: 0.25rem;
    }
    
    .invalid-feedback {
        font-size: 0.85rem;
        margin-top: 0.5rem;
        margin-left: 0.25rem;
    }
    
    /* Custom focus styles */
    .form-control:focus, .form-select:focus {
        border-width: 2px;
    }
    
    /* Animated validation */
    .was-validated .form-control:valid, .was-validated .form-select:valid {
        border-color: #2ba640 !important;
        background-image: none;
    }
    
    .was-validated .form-control:invalid, .was-validated .form-select:invalid {
        border-color: #ff4e45 !important;
        background-image: none;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem;
        }
        
        .btn {
            padding: 0.6rem 1.2rem;
        }
    }
</style>

<script>
// Toggle password visibility
document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    
    if (togglePassword && password && eyeIcon) {
        togglePassword.addEventListener('click', function() {
            // Toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            
            // Toggle the eye icon
            if (type === 'password') {
                eyeIcon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
            } else {
                eyeIcon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
            }
        });
    }
    
    // Enhanced client-side validation
    const forms = document.querySelectorAll('.needs-validation');
    
    Array.prototype.slice.call(forms).forEach(function(form) {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                
                // Find the first invalid element and focus it
                const invalidElement = form.querySelector(':invalid');
                if (invalidElement) {
                    invalidElement.focus();
                }
            }
            
            form.classList.add('was-validated');
        }, false);
    });
});
</script>
@endsection