@extends('layouts.masternonauth')

@section('title', 'Login')

@section('headerStyle')
<link rel="stylesheet" media="screen, print" href="{{ url(env('ASSETS_PATH').'/css/fa-brands.css') }}">
@stop


@section('content')

<style>
    h2{
        font-size: 17px;
        font-weight: 500;
    }

    h1{
        font-size: 25px;
        font-weight: 900;
    }

    h3{
        font-size: 18px;
        font-weight: 900;
    }

    p{
        font-size: 13px;
    }

    .btn-group-lg>.btn, .btn-lg {
        padding: .6rem 4rem;
    }

    .page-inner{
        background-image: linear-gradient(to right,rgb(255, 255, 255) 50%, rgba(0, 0, 0, 0) 7%), 
                          url({{ ("assets/img/backgrounds/dark_bg.jpg") }});
        background-size: contain;
        background-position: right;
    }

    @media only screen and (max-width : 991px) {
        h1{
            font-size: 22px;
        }

        h2 {
            font-size: 14px;
        }

        h3 {
            font-size: 14px;
        }
    }

    @media only screen and (max-width : 574px) {
        .page-inner{
            background-image: linear-gradient(to right,rgb(255, 255, 255) 0%, rgba(0, 0, 0, 0) 0%), 
                            url({{ asset("assets/img/backgrounds/dark_bg.jpg") }});
        }
    }
    
</style>

<div class="page-wrapper">
    <div class="page-inner bg-brand-gradient">
        <div class="m-0 bg-transparent page-content-wrapper">
    <div class="page-inner">
    <div class="m-0 bg-transparent page-content-wrapper">
            <div class="flex-1" style="background: url(assets/img/svg/pattern-1.svg) no-repeat center bottom fixed; background-size: cover;">
                <div class="container d-block align-items-center h-100">
                    <div class="row h-100">
                        <div class="col col-md-6 col-lg-6 hidden-sm-down d-flex flex-column justify-content-center ">
                        </div>
                        <div class="ml-auto col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="row h-100 align-items-center">
                                <div class="ml-auto col-sm-11 col-md-11 col-lg-11 col-xl-11">
                                <div class="p-3 p-md-5 card rounded-plus bg-light">
                                    <form method="POST" action="{{ route('login') }}">


                                        @csrf
                                        <h2>
                                            WELCOME TO
                                        </h2>

                                        <h1>
                                             Dream Jar
                                        </h1>

                                        <h3 class="mt-5 mb-3">
                                            LOGIN
                                        </h3>

                                        <div class="mb-3 form-group">
                                            <input id="email" 
                                                type="text" 
                                                class="form-control @error('email') is-invalid @enderror" 
                                                placeholder="Enter your Email" 
                                                name="email" 
                                                value="{{ old('email') }}" 
                                                required 
                                                autocomplete="email" 
                                                autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                            <div id="nic-js-error" class="invalid-feedback" style="display: none;"></div>

                                        </div>

                                       <div class="form-group">
                                            <div class="input-group">
                                                <input id="password" 
                                                    type="password" 
                                                    class="form-control @error('password') is-invalid @enderror" 
                                                    placeholder="Password" 
                                                    name="password" 
                                                    required 
                                                    autocomplete="current-password">
                                                
                                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                    <i class="fal fa-eye" id="togglePasswordIcon"></i>
                                                </button>

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row no-gutters">
                                            <div class="my-2 col-lg-6 pr-lg-1">
                                                <button id="js-login-btn" type="submit" class="btn btn-primary login-btn btn-lg">Login</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                        </div>
                        @include('layouts/partials/footer-sm')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footerScript')
    <script>
        $("#js-login-btn").click(function(event) {
            var form = $("#js-login")
            if (form[0].checkValidity() === false) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.addClass('was-validated');
        });

        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePasswordIcon');

            togglePassword.addEventListener('click', function () {
                // Toggle the type attribute
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                // Toggle the icon
                if (type === 'password') {
                    // If type is password, show the 'eye' icon
                    toggleIcon.classList.remove('fa-eye-slash');
                    toggleIcon.classList.add('fa-eye');
                } else {
                    // If type is text, show the 'eye-slash' icon
                    toggleIcon.classList.remove('fa-eye');
                    toggleIcon.classList.add('fa-eye-slash');
                }
            });
        });
    </script>
@stop
