<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Global styles */
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #000000;
            color: #ff69b4;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .container {
            padding: 20px;
        }
        a {
            color: #ff69b4;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        a:hover {
            color: #ff85c0;
            text-decoration: underline;
        }
        /* Navbar styles */
        .navbar {
            background-color: #1c1c1c;
            padding: 10px 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .navbar a {
            font-size: 1.2rem;
            margin-right: 15px;
        }
        /* Footer styles */
        footer {
            background-color: #1c1c1c;
            color: #ff69b4;
            text-align: center;
            padding: 15px;
            margin-top: auto;
            box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.2);
        }
        footer p {
            margin: 0;
            font-size: 1rem;
        }
        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #1c1c1c;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ff69b4;
        }
        th {
            background-color: #333;
            color: #ff69b4;
            text-transform: uppercase;
        }
        tr:hover {
            background-color: #2e2e2e;
            transition: background-color 0.3s ease;
        }
        .btn {
            color: #fff;
            background-color: #ff69b4;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #ff85c0;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <a href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('tasks.index') }}">Tasks</a>
        <a href="{{ route('users.index') }}">Users</a>
        <!-- Add more links as needed -->
    </nav>

    <!-- Page Content -->
    <div class="container">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
        <p>Contact us: email@example.com</p>
    </footer>
</body>
</html>
