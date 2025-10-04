@extends('layouts.masternonauth')

@section('title', 'Login to Dream Jar')

@section('headerStyle')
    {{-- Using a more common Font Awesome style, but you can adjust if needed --}}
    <link rel="stylesheet" media="screen, print" href="{{ url(env('ASSETS_PATH').'/css/fa-solid.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ url(env('ASSETS_PATH').'/css/fa-brands.css') }}">
@stop

@section('content')

<style>
    /* ============================================
    Modern Login Page Styles for Dream Jar
    ============================================
    */

    /* CSS Variables for easy theme management */
    :root {
        --primary-color: #34D399; /* Emerald Green - Represents growth, savings */
        --primary-hover: #2aa77c;
        --secondary-bg: #F8FAFC;  /* Very light gray for the form side */
        --text-dark: #1E293B;      /* Dark slate for headings */
        --text-light: #64748B;     /* Lighter slate for paragraphs/labels */
        --border-color: #E2E8F0;   /* Light gray for borders */
        --white-color: #FFFFFF;
        --font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }

    /* Resetting parent styles to ensure full page layout */
    .page-wrapper, .page-inner, .page-content-wrapper, body, html {
        margin: 0;
        padding: 0;
        height: 100%;
        width: 100%;
        font-family: var(--font-family);
    }
    
    .login-container {
        display: flex;
        width: 100%;
        min-height: 100vh;
        background-color: var(--secondary-bg);
    }

    /* --- Branding Side (Left) --- 
    */
    .branding-side {
        width: 50%;
        background: linear-gradient(160deg, #10B981, #34D399);
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: var(--white-color);
        padding: 40px;
    }

    .branding-content h1 {
        font-size: 3.5rem; /* 56px */
        font-weight: 800;
        margin-bottom: 1rem;
        letter-spacing: -1px;
    }

    .branding-content p {
        font-size: 1.125rem; /* 18px */
        font-weight: 400;
        max-width: 400px;
        line-height: 1.6;
        opacity: 0.9;
    }

    /* --- Form Side (Right) --- 
    */
    .form-side {
        width: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 40px;
    }

    .form-wrapper {
        width: 100%;
        max-width: 420px;
    }

    .form-wrapper .form-header h2 {
        font-size: 2rem; /* 32px */
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }

    .form-wrapper .form-header p {
        font-size: 1rem; /* 16px */
        color: var(--text-light);
        margin-bottom: 2.5rem; /* 40px */
    }

    .form-group {
        margin-bottom: 1.5rem; /* 24px */
    }

    .form-label {
        display: block;
        font-size: 0.875rem; /* 14px */
        font-weight: 500;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }

    /* Modern Input Styling */
    .form-control {
        display: block;
        width: 100%;
        padding: 0.875rem 1rem; /* 14px 16px */
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: var(--text-dark);
        background-color: var(--white-color);
        background-clip: padding-box;
        border: 1px solid var(--border-color);
        appearance: none;
        border-radius: 0.5rem; /* 8px */
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .form-control:focus {
        color: var(--text-dark);
        background-color: var(--white-color);
        border-color: var(--primary-color);
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgba(52, 211, 153, 0.25);
    }
    .form-control.is-invalid {
        border-color: #dc3545;
    }

    /* Password Toggle Integration */
    .input-group {
        position: relative;
    }
    #togglePassword {
        position: absolute;
        top: 50%;
        right: 1rem;
        transform: translateY(-50%);
        border: none;
        background: none;
        cursor: pointer;
        padding: 0;
        color: var(--text-light);
    }

    /* Modern Button Styling */
    .btn-primary.login-btn {
        width: 100%;
        padding: 0.875rem 1rem; /* 14px 16px */
        font-size: 1rem;
        font-weight: 600;
        color: var(--white-color);
        background-color: var(--primary-color);
        border: none;
        border-radius: 0.5rem;
        cursor: pointer;
        transition: background-color 0.2s ease-in-out;
        box-shadow: 0 4px 15px rgba(52, 211, 153, 0.2);
    }

    .btn-primary.login-btn:hover {
        background-color: var(--primary-hover);
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .branding-side {
            display: none; /* Hide the branding section on tablets and smaller */
        }

        .form-side {
            width: 100%;
        }
    }

    @media (max-width: 576px) {
        .form-side {
            padding: 20px;
        }

        .form-wrapper .form-header h2 {
            font-size: 1.75rem;
        }
    }
</style>

<div class="login-container">
    <div class="branding-side">
        <div class="branding-content">
            <h1>Dream Jar</h1>
            <p>Your personal piggy bank, reimagined for the digital age. Save smarter, reach your goals faster.</p>
        </div>
    </div>

    <div class="form-side">
        <div class="form-wrapper">
            <div class="form-header">
                <h2>Welcome Back!</h2>
                <p>Log in to continue tracking your goals.</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input id="email" 
                        type="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        placeholder="you@example.com" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        autocomplete="email" 
                        autofocus>

                    @error('email')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input id="password" 
                            type="password" 
                            class="form-control @error('password') is-invalid @enderror" 
                            placeholder="Enter your password" 
                            name="password" 
                            required 
                            autocomplete="current-password">
                        
                        <button class="btn" type="button" id="togglePassword">
                            <i class="fa-solid fa-eye" id="togglePasswordIcon"></i>
                        </button>

                        @error('password')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <button id="js-login-btn" type="submit" class="btn btn-primary login-btn">Log In</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('footerScript')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.getElementById('togglePassword');
        if (togglePassword) {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePasswordIcon');

            togglePassword.addEventListener('click', function () {
                // Toggle the type attribute
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                // Toggle the icon
                toggleIcon.classList.toggle('fa-eye');
                toggleIcon.classList.toggle('fa-eye-slash');
            });
        }
    });

    // Your original validation script can be kept if it's part of a larger theme system
    // For this standalone design, standard HTML5 validation is sufficient.
    $("#js-login-btn").click(function(event) {
        var form = $(this).closest("form"); // Use jQuery to find the parent form
        if (form[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.addClass('was-validated');
    });
</script>
@stop