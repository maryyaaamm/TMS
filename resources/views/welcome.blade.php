<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management System</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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

        /* Navbar Styles */
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

        /* Content Styles */
        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background-color: #222; /* Dark background for content area */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Subtle shadow */
        }
        .content h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #ff69b4; /* Pink text color */
        }
        .content p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            color: #ffffff; /* White text color */
        }

        /* Button Styles */
        .buttons {
            display: flex;
            gap: 1rem;
        }
        .btn {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.2s ease; /* Smooth transitions */
        }
        .btn-primary {
            background-color: #ff69b4; /* Pink background */
            color: #ffffff; /* White text color */
            border: 1px solid #ff69b4; /* Pink border */
        }
        .btn-secondary {
            background-color: #111; /* Black background */
            color: #ff69b4; /* Pink text color */
            border: 1px solid #ff69b4; /* Pink border */
        }
        .btn-primary:hover {
            background-color: #ff1493; /* Darker pink on hover */
            transform: scale(1.05); /* Slight scale effect */
        }
        .btn-secondary:hover {
            background-color: #222; /* Darker black on hover */
            transform: scale(1.05); /* Slight scale effect */
        }

        /* Footer Styles */
        footer {
            background-color: #111; /* Darker black for footer */
            color: #ff69b4; /* Pink text color */
            text-align: center;
            padding: 1rem 0;
            border-top: 2px solid #ff69b4; /* Pink top border */
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="{{ url('/') }}">Task Management System</a>
        <div>
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        </div>
    </nav>
    <div class="content">
        <h1>Welcome to the Task Management System</h1>
        <p>Manage your tasks effectively and efficiently with our simple and easy-to-use interface.</p>
        <div class="buttons">
            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
        </div>
    </div>
    <footer>
        &copy; 2024 Task Management System. All rights reserved.
    </footer>
</body>
</html>
