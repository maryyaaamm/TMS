<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            background-image: url('data:image/jpeg;base64,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'); /* Background image */
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
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h2>Employee Task Management System</h2>
        </div>
        <div class="form-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    @error('email')
                        <span class="form-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
                    @error('password')
                        <span class="form-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="remember_me" class="form-check-label">
                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember" />
                        <span class="form-check-text">Remember me</span>
                    </label>
                </div>

                <div class="form-footer">
                    @if (Route::has('password.request'))
                        <a class="form-forgot-password" href="{{ route('password.request') }}">
                            Forgot your password?
                        </a>
                    @endif

                    <button type="submit" class="btn btn-primary">
                        Log in
                    </button>
                </div>

                <div class="extra-links">
                    <a href="#">Home Page</a>
                    <a href="#">Contact Support</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
