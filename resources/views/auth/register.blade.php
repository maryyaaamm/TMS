<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Global Styles */
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #E9F1F7; /* Light Blue background */
            color: #333; /* Dark Gray text color */
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        .form-container {
            max-width: 500px; /* Increased width for better visibility */
            width: 100%; /* Ensure full width within the max-width constraint */
            background-color: #FFFFFF; /* White background for form container */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            overflow: hidden; /* Ensures the image header doesn't overflow */
        }

         .form-header {
          
            background-size: cover;
            background-position: center;
            padding: 2rem;
            text-align: center;
        } 

        .form-header h2 {
            font-size: 1.75rem; /* Font size for header */
            color: #FFFFFF; /* White color for header text */
            margin: 0;
        }

        .form-body {
            padding: 2rem; /* Padding for form body */
        }

        .form-group {
            margin-bottom: 1.25rem; /* Margin between form fields */
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem; /* Margin below label */
            font-size: 1rem;
            color: #333; /* Dark Gray text color */
        }

        .form-control {
            width: 100%;
            padding: 0.75rem; /* Padding for input fields */
            border-radius: 6px;
            border: 1px solid #CED4DA; /* Light Gray border */
            background-color: #FFFFFF; /* White background for inputs */
            color: #333; /* Dark Gray text color */
            transition: border-color 0.3s ease; /* Smooth border color transition */
        }

        .form-control:focus {
            border-color: #007BFF; /* Blue border on focus */
            outline: none;
        }

        .btn {
            padding: 0.75rem 1.5rem; /* Padding for buttons */
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease; /* Smooth transitions */
        }

        .btn-primary {
            background-color: #007BFF; /* Blue background */
            color: #FFFFFF; /* White text color */
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Darker Blue on hover */
            transform: scale(1.05); /* Slight scale effect */
        }

        .form-footer {
            margin-top: 1.5rem;
            text-align: center;
        }

        .form-forgot-password {
            color: #007BFF; /* Blue color for forgot password link */
            text-decoration: none;
            display: block;
            margin-bottom: 1rem; /* Margin below the link */
            font-size: 0.9rem;
        }

        .form-forgot-password:hover {
            text-decoration: underline;
        }

        /* Styling for additional links */
        .extra-links {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
        }

        .extra-links a {
            color: #FF6347; /* Light Red for additional links */
            text-decoration: none;
        }

        .extra-links a:hover {
            text-decoration: underline;
        }
        .form-container h2 {
            font-size: 1.75rem; /* Font size for header */
            color: #007BFF; /* Blue color for header */
            margin-bottom: 1.5rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h2>Register</h2>
        </div>
        <div class="form-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <label for="name" class="form-label">
                        {{ __('Name') }}
                    </label>
                    <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                    @error('name')
                        <span class="text-red-600 text-sm mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label">
                        {{ __('Email') }}
                    </label>
                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                    @error('email')
                        <span class="text-red-600 text-sm mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">
                        {{ __('Password') }}
                    </label>
                    <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="text-red-600 text-sm mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">
                        {{ __('Confirm Password') }}
                    </label>
                    <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password">
                    @error('password_confirmation')
                        <span class="text-red-600 text-sm mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-footer">
                    <a class="form-forgot-password" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
