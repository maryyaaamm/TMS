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
        max-width: 600px;
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
        <h2>Register</h2>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</div>
@endsection
