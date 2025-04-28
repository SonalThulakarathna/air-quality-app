@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card bg-dark border-0 shadow-lg">
                <div class="card-header bg-gradient-primary-to-secondary p-4">
                    <h2 class="h4 text-white mb-0 d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="8.5" cy="7" r="4"></circle>
                            <line x1="20" y1="8" x2="20" y2="14"></line>
                            <line x1="23" y1="11" x2="17" y2="11"></line>
                        </svg>
                        Admin Registration
                    </h2>
                </div>
                
                <div class="card-body px-4 py-5">
                    <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                        @csrf
                        
                        <div class="mb-4">
                            <label for="name" class="form-label text-light fw-medium mb-2">Full Name</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-dark border-secondary text-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </span>
                                <input type="text" 
                                       class="form-control form-control-lg bg-dark text-light border-secondary @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}" 
                                       placeholder="John Doe"
                                       required 
                                       autocomplete="name" 
                                       autofocus>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

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
                                       autocomplete="email">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-text text-muted small mt-2">We'll never share your email with anyone else.</div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label text-light fw-medium mb-2">Password</label>
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
                                       autocomplete="new-password">
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
                            <div id="passwordStrength" class="mt-2 progress" style="height: 5px; display: none;">
                                <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div id="passwordFeedback" class="form-text small mt-1"></div>
                        </div>

                        <div class="mb-4">
                            <label for="password-confirm" class="form-label text-light fw-medium mb-2">Confirm Password</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-dark border-secondary text-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                </span>
                                <input type="password" 
                                       class="form-control form-control-lg bg-dark text-light border-secondary" 
                                       id="password-confirm" 
                                       name="password_confirmation" 
                                       placeholder="••••••••"
                                       required 
                                       autocomplete="new-password">
                            </div>
                            <div id="passwordMatch" class="form-text small mt-1"></div>
                        </div>

                        <div class="mb-4 mt-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                                <label class="form-check-label text-light" for="terms">
                                    I agree to the <a href="#" class="text-primary">Terms of Service</a> and <a href="#" class="text-primary">Privacy Policy</a>
                                </label>
                                <div class="invalid-feedback">
                                    You must agree before submitting.
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="8.5" cy="7" r="4"></circle>
                                    <line x1="20" y1="8" x2="20" y2="14"></line>
                                    <line x1="23" y1="11" x2="17" y2="11"></line>
                                </svg>
                                Create Account
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <p class="text-light mb-0">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-primary fw-medium text-decoration-none">Login here</a>
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
    
    /* Password strength colors */
    .progress-bar.bg-danger { background-color: #ff4e45 !important; }
    .progress-bar.bg-warning { background-color: #ffd600 !important; }
    .progress-bar.bg-info { background-color: #3ea6ff !important; }
    .progress-bar.bg-success { background-color: #2ba640 !important; }
    
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
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('password-confirm');
    const eyeIcon = document.getElementById('eyeIcon');
    const passwordStrength = document.getElementById('passwordStrength');
    const passwordFeedback = document.getElementById('passwordFeedback');
    const passwordMatch = document.getElementById('passwordMatch');
    const progressBar = passwordStrength.querySelector('.progress-bar');
    
    if (togglePassword && password && eyeIcon) {
        togglePassword.addEventListener('click', function() {
            // Toggle the type attribute for both password fields
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            confirmPassword.setAttribute('type', type);
            
            // Toggle the eye icon
            if (type === 'password') {
                eyeIcon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
            } else {
                eyeIcon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
            }
        });
    }
    
    // Password strength meter
    if (password && passwordStrength && passwordFeedback) {
        password.addEventListener('input', function() {
            const value = password.value;
            
            if (value.length > 0) {
                passwordStrength.style.display = 'flex';
                
                // Calculate strength
                let strength = 0;
                let feedback = '';
                
                // Length check
                if (value.length >= 8) {
                    strength += 25;
                }
                
                // Uppercase check
                if (/[A-Z]/.test(value)) {
                    strength += 25;
                }
                
                // Lowercase check
                if (/[a-z]/.test(value)) {
                    strength += 25;
                }
                
                // Number/special char check
                if (/[0-9!@#$%^&*(),.?":{}|<>]/.test(value)) {
                    strength += 25;
                }
                
                // Update progress bar
                progressBar.style.width = strength + '%';
                progressBar.setAttribute('aria-valuenow', strength);
                
                // Set color and feedback based on strength
                if (strength <= 25) {
                    progressBar.className = 'progress-bar bg-danger';
                    feedback = 'Very weak password';
                } else if (strength <= 50) {
                    progressBar.className = 'progress-bar bg-warning';
                    feedback = 'Weak password - add uppercase letters and numbers';
                } else if (strength <= 75) {
                    progressBar.className = 'progress-bar bg-info';
                    feedback = 'Good password - add more variety';
                } else {
                    progressBar.className = 'progress-bar bg-success';
                    feedback = 'Strong password!';
                }
                
                passwordFeedback.textContent = feedback;
                passwordFeedback.className = 'form-text small mt-1 text-' + 
                    (strength <= 25 ? 'danger' : 
                     strength <= 50 ? 'warning' : 
                     strength <= 75 ? 'info' : 'success');
            } else {
                passwordStrength.style.display = 'none';
                passwordFeedback.textContent = '';
            }
            
            // Check password match
            checkPasswordMatch();
        });
    }
    
    // Password match check
    if (confirmPassword && passwordMatch) {
        confirmPassword.addEventListener('input', checkPasswordMatch);
        
        function checkPasswordMatch() {
            if (confirmPassword.value.length > 0) {
                if (password.value === confirmPassword.value) {
                    passwordMatch.textContent = 'Passwords match!';
                    passwordMatch.className = 'form-text small mt-1 text-success';
                    confirmPassword.setCustomValidity('');
                } else {
                    passwordMatch.textContent = 'Passwords do not match';
                    passwordMatch.className = 'form-text small mt-1 text-danger';
                    confirmPassword.setCustomValidity('Passwords do not match');
                }
            } else {
                passwordMatch.textContent = '';
                confirmPassword.setCustomValidity('');
            }
        }
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