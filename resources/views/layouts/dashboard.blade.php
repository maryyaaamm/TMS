<!DOCTYPE html>
<html lang="en">

<head>
    @stack('scripts')

    <!-- Bootstrap CSS and dependencies -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <!-- Include Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        roboto: ['Roboto', 'sans-serif'],
                    },
                    colors: {
                        'teal': '#468189',
                        'light-beige': '#FAF3E0',
                        'dark-brown': '#4B3832',
                        'mustard': '#F3CA20'
                    }
                }
            }
        }
    </script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

   <style>
    /* Ensure these styles come after DataTable's default styles */
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.5em 1em;
        margin: 0 0.1em;
        border: 1px solid #333;
        border-radius: 4px;
        background-color: #000;
        color: #fff;
        text-align: center;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background-color: #333;
        color: #fff;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background-color: #666;
        color: #fff;
        border: 1px solid #666;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
        background-color: #444;
        color: #777;
        cursor: not-allowed;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button span {
        display: block;
        line-height: 1.5;
    }

    /* Custom styling for the DataTable search input */
    .dataTables_wrapper .dataTables_filter input {
        color: black; /* Set the text color to black */
    }
</style>

</head>

<body class="font-sans flex flex-col min-h-screen bg-light-beige text-white">
    <nav class="bg-[#15283c] p-4 shadow-md fixed top-0 left-0 w-full z-50 flex justify-between items-center">
        <div class="logo text-blue-600 text-2xl font-bold">
            <a href="{{ url('/') }}" class="text-white hover:text-blue-800">TASK MANAGEMENT SYSTEM</a>
        </div>
        <div class="nav-links flex items-center space-x-6">
            @auth
                @if(Auth::user()->hasRole('admin'))
                    <a href="{{ url('/') }}" class="text-lg text-gray-600 hover:text-blue-600 flex items-center">
                        <i class="fas fa-home mr-2"></i> Home
                    </a>
                    <a href="{{ route('dashboard') }}" class="text-lg text-gray-600 hover:text-blue-600 flex items-center">
                        <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                    </a>
                    <a href="{{ route('tasks.index') }}" class="text-lg text-gray-600 hover:text-blue-600 flex items-center">
                        <i class="fas fa-tasks mr-2"></i> Tasks
                    </a>
                @endif
                
                <form action="{{ route('logout') }}" method="POST" class="inline-block">
                    @csrf
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition ease-in-out duration-200 transform hover:scale-105">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            @endauth
        </div>
    </nav>

    <!-- Main content container with Flexbox -->
    <div class="flex flex-grow pt-16">
        <!-- Sidebar -->
        <div class="text-white w-64 p-4 flex flex-col items-center min-w-max bg-[#163e4e] shadow-lg">
            <div class="mb-8 flex justify-center items-center">
                <!-- Profile Picture or Logo -->
                <img src="https://th.bing.com/th/id/OIP.MAleQeDj2W5A7kkxCfLMjgHaFj?w=233&h=180&c=7&r=0&o=5&pid=1.7" alt="Logo" class="w-20 h-20 rounded-full object-cover mt-4">
            </div>
            
            <ul class="space-y-4 w-full">
                @unless (Auth::user()->hasRole('superadmin'))
                    <li>
                        <a href="{{ route('tasks.userTasks') }}" class="flex items-center text-white hover:text-[#007bff] hover:bg-[#495057] px-4 py-3 rounded-md text-lg transition ease-in-out duration-300 transform hover:scale-105">
                            <i class="fas fa-home mr-3"></i> Your Tasks
                        </a>
                    </li>
                @endunless

                @if (Auth::user()->hasRole('superadmin'))
                    <li>
                        <a href="{{ route('dashboard') }}" class="flex items-center text-white hover:text-primary hover:bg-gray-700 px-4 py-3 rounded-md text-lg transition duration-300">
                            <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tasks.create') }}" class="flex items-center text-white hover:text-[#007bff] hover:bg-[#495057] px-4 py-3 rounded-md text-lg transition ease-in-out duration-300 transform hover:scale-105">
                            <i class="fas fa-plus-circle mr-3"></i> Create Task
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tasks.index') }}" class="flex items-center text-white hover:text-[#007bff] hover:bg-[#495057] px-4 py-3 rounded-md text-lg transition ease-in-out duration-300 transform hover:scale-105">
                            <i class="fas fa-tasks mr-3"></i> Manage Users Tasks
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}" class="flex items-center text-white hover:text-primary hover:bg-gray-700 px-4 py-3 rounded-md text-lg transition duration-300">
                            <i class="fas fa-user mr-3"></i> Users
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tasks.reports') }}" class="flex items-center text-white hover:text-primary hover:bg-gray-700 px-4 py-3 rounded-md text-lg transition duration-300">
                            <i class="fas fa-file-alt mr-3"></i> Task Reports
                        </a>
                    </li>
                @endif
            </ul>
        </div>

        <!-- Page Content -->
        <main class="container-fluid p-4 bg-white flex-grow">
            @yield('content')
        </main>
    </div>

    <!-- JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    @stack('scripts')
</body>

</html>
