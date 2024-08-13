@extends('layouts.app')

@section('content')
<style>
    /* Global Styles */
    body {
        font-family: 'Nunito', sans-serif;
        background-color: #000000; /* Black background */
        color: #ffffff; /* White text color */
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        margin: 0;
    }
    
    .navbar {
        background-color: #111; /* Darker black for navbar */
        padding: 1rem;
        color: #ff69b4; /* Pink text color */
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid #ff69b4; /* Pink bottom border */
    }
    
    .navbar a {
        color: #ff69b4; /* Pink text color */
        margin-right: 1rem;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease; /* Smooth color transition */
    }
    
    .navbar a:hover {
        color: #ffffff; /* White color on hover */
    }
    
    .container {
        padding: 2rem;
    }

    .form-container {
        max-width: 400px;
        margin: 0 auto;
        background-color: #222; /* Dark background for form container */
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Subtle shadow */
    }
    
    .form-container h2 {
        font-size: 2rem;
        color: #ff69b4; /* Pink text color */
        margin-bottom: 1rem;
        text-align: center;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-size: 1rem;
        color: #ff69b4; /* Pink text color */
    }
    
    .form-control {
        width: 100%;
        padding: 0.75rem;
        border-radius: 5px;
        border: 1px solid #ff69b4; /* Pink border */
        background-color: #333; /* Dark background for inputs */
        color: #ffffff; /* White text color */
        transition: border-color 0.3s ease; /* Smooth border color transition */
    }
    
    .form-control:focus {
        border-color: #ff1493; /* Darker pink on focus */
        outline: none;
    }
    
    .btn {
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        font-weight: 600;
        text-decoration: none;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease; /* Smooth transitions */
    }
    
    .btn-primary {
        background-color: #ff69b4; /* Pink background */
        color: #ffffff; /* White text color */
        border: 1px solid #ff69b4; /* Pink border */
    }
    
    .btn-primary:hover {
        background-color: #ff1493; /* Darker pink on hover */
        transform: scale(1.05); /* Slight scale effect */
    }

    footer {
        background-color: #111; /* Darker black for footer */
        color: #ff69b4; /* Pink text color */
        text-align: center;
        padding: 1rem 0;
        border-top: 2px solid #ff69b4; /* Pink top border */
    }
</style>

<div class="container">
    <div class="form-container">
        <h2>Log in</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <x-input-label for="email" :value="__('Email')" class="form-label" />
                <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="form-error" />
            </div>

            <!-- Password -->
            <div class="form-group">
                <x-input-label for="password" :value="__('Password')" class="form-label" />
                <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="form-error" />
            </div>

            <!-- Remember Me -->
            <div class="form-group">
                <label for="remember_me" class="form-check-label">
                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember" />
                    <span class="form-check-text">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="form-footer">
                @if (Route::has('password.request'))
                    <a class="form-forgot-password" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="btn btn-primary">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
@endsection
