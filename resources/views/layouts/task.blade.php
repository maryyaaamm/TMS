<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Bootstrap JS and dependencies -->
    {{-- 
    <!-- Tailwind CSS -->
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
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
  
  
   <!-- DataTables CSS -->


</head>

<body class="font-sans flex flex-col min-h-screen bg-light-beige text-white">

    <!-- Navbar -->
    <nav class="bg-black p-4 shadow-md flex justify-between items-center">
        <div class="logo text-blue-600 text-2xl font-bold">
            <a href="{{ url('/') }}" class="text-blue-600 hover:text-blue-800">Task Manager</a>
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
    

    <!-- Page Content -->
    <main class="container-fluid p-0 m-0">
        @yield('content')
    </main>
  
  <!-- DataTables Initialization -->
  {{-- <script>
    $(document).ready(function() {
        $('#tasksTable').DataTable({
            paging: false,  // Disable pagination
            searching: true,
            language: {
                search: '',
                searchPlaceholder: "Search tasks...",
            },
            dom: '<"d-flex justify-content-between align-items-center"f>t<"d-flex justify-content-between align-items-center"ip>',
        });

        // Add search icon to the search input
        $('.dataTables_filter input[type="search"]').addClass('form-control').after('<i class="fas fa-search search-icon"></i>');
    });
</script> --}}

</body>

</html>
