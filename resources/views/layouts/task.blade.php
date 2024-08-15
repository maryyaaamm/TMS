<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Extend Tailwind CSS with custom colors
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'soft-pink': '#D4A5A5',
                        'teal': '#468189',
                        'light-beige': '#FAF3E0',
                        'dark-brown': '#4B3832',
                        'mustard': '#F3CA20'
                    }
                }
            }
        }
    </script>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="font-sans flex flex-col min-h-screen bg-light-beige text-white">

    <!-- Navbar -->
    <nav class="bg-black p-4 shadow-md flex justify-between items-center">
        <div class="logo text-mustard text-2xl font-bold">
            <a href="{{ url('/') }}" class="text-mustard">Task Manager</a>
        </div>
        <div class="nav-links flex items-center space-x-6">
            @auth
                @if(Auth::user()->hasRole('admin'))
                    <a href="{{ url('/') }}" class="text-lg hover:text-teal flex items-center">
                        <i class="fas fa-home mr-2"></i> Home
                    </a>
                    <a href="{{ route('dashboard') }}" class="text-lg hover:text-teal flex items-center">
                        <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                    </a>
                    {{-- <a href="{{ route('tasks.index') }}" class="text-lg hover:text-teal flex items-center">
                        <i class="fas fa-tasks mr-2"></i> Tasks
                    </a> --}}
                    {{-- <a href="{{ route('users.index') }}" class="text-lg hover:text-teal flex items-center">
                        <i class="fas fa-users mr-2"></i> Users
                    </a> --}}
                @endif
                <a href="{{ url('/') }}" class="text-lg hover:text-teal flex items-center">
                    <i class="fas fa-home mr-2"></i> Home
                </a>
                <a href="{{ route('dashboard') }}" class="text-lg hover:text-teal flex items-center">
                    <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                </a>
                {{-- <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-[#468189] text-white px-6 py-3 rounded-lg hover:bg-[#F3CA20] transition ease-in-out duration-200 transform hover:scale-105">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form> --}}
            @endauth
        </div>
    </nav>

    <!-- Page Content -->
    <main class="container-fluid p-0 m-0">
        @yield('content')
    </main>
    <footer class="bg-black text-light-beige text-center py-6 border-t-2 border-teal">
        <div class="max-w-screen-md mx-auto">
            <!-- Top Section: Company Info and Contact -->
            <div class="mb-4">
                <p class="text-xl font-bold">&copy; 2024 {{ config('app.name') }}. All rights reserved.</p>
                <p class="text-lg">Contact us: email@example.com</p>
            </div>

            <!-- Middle Section: Quotes -->
            {{-- <div class="mb-4 italic text-lg">
                <p>"Efficiency is doing things right; effectiveness is doing the right things."</p>
            </div> --}}

            <!-- Bottom Section: Footer Details and Social Links -->
            <div class="flex justify-center gap-4">
                <a href="#" class="text-teal text-2xl"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-teal text-2xl"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-teal text-2xl"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" class="text-teal text-2xl"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
