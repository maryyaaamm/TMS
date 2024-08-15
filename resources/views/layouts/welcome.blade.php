<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    
        <!-- DataTables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    
        <!-- jQuery and DataTables JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    
        <!-- DataTables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    
        <!-- jQuery and DataTables JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    
        <!-- Bootstrap JS and dependencies -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
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
    
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
<body>
    <body class="font-sans flex flex-col min-h-screen bg-light-beige text-white">

        <!-- Navbar -->
        <nav class="bg-black p-4 shadow-md flex justify-between items-center">
            <div class="logo text-mustard text-2xl font-bold">
                <a href="{{ url('/') }}" class="text-mustard">Task Manager</a>
            </div>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <!-- Login Button -->
                <a href="{{ route('login') }}" class="flex items-center px-6 py-3 bg-soft-pink text-white font-semibold rounded-lg hover:bg-mustard transition duration-300 transform hover:scale-105">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </a>
                <!-- Register Button -->
                <a href="{{ route('register') }}" class="flex items-center px-6 py-3 bg-teal text-white font-semibold rounded-lg hover:bg-teal-500 transition duration-300 transform hover:scale-105">
                    <i class="fas fa-user-plus mr-2"></i> Register
                </a>
            </div>
        </nav>
    
        <!-- Page Content -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    
        <!-- Footer -->
        <footer class="bg-black text-light-beige text-center py-6 border-t-2 border-teal">
            <div class="max-w-screen-md mx-auto">
                <!-- Top Section: Company Info and Contact -->
                <div class="mb-4">
                    <p class="text-xl font-bold">&copy; 2024 {{ config('app.name') }}. All rights reserved.</p>
                    <p class="text-lg">Contact us: email@example.com</p>
                </div>
        
                <!-- Middle Section: Quotes -->
                <div class="mb-4 italic text-lg">
                    <p>"Efficiency is doing things right; effectiveness is doing the right things."</p>
                </div>
                
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
</body>
</html>