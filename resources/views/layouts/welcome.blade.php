<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management System</title>
    
    <!-- FontAwesome and Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }

        .carousel-background {
            background-image: url('https://images.unsplash.com/photo-1542281286-9e0a16bb7366?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body class="bg-white text-blue-800 flex flex-col min-h-screen">
  
    <!-- Navbar -->
    <nav class="bg-black p-6">
        <div class="container mx-auto flex justify-between items-center">
            <div class="logo text-blue-600 text-2xl font-bold">
                <a href="{{ url('/') }}" class="text-white hover:text-blue-800">EMPLOYEE TASK</a>
            </div>
            <div class="flex gap-4">
                <a href="{{ route('home') }}" class="text-white px-4 py-2 hover:text-green-500">Home</a>
                <a href="{{ route('login') }}" class="text-white px-4 py-2 hover:text-green-500">Login</a>
                <a href="{{ route('register') }}" class="text-white px-4 py-2 hover:text-green-500">Register</a>
            </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="carousel-background h-screen flex items-center justify-center text-center text-white relative animate__animated animate__fadeIn">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative z-10">
            <h1 class="text-6xl font-bold">Improving Workplace <span class="text-green-500">Productivity</span></h1>
            <p class="mt-4 text-lg">Hire. Train. Retain.</p>
            <a href="#" class="mt-6 inline-block px-8 py-3 bg-green-500 text-white font-semibold rounded-lg shadow-lg hover:bg-green-400 transition duration-300 transform hover:scale-105">Read More</a>
        </div>
    </div>

    <!-- About Us Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto text-center md:text-left grid md:grid-cols-2 gap-8">
            <div class="flex items-center justify-center">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQTHsXafT1Ik2aP74cRQ8zXhGassW-r9Ldkfg&s" alt="About Us Image" class="rounded-lg shadow-lg max-w-full animate__animated animate__zoomIn">
            </div>
            <div class="md:flex md:items-center">
                <div class="p-6">
                    <h2 class="text-4xl font-bold text-blue-800 mb-4">About Us</h2>
                    <p class="text-lg text-gray-700 mb-4">Employee Task Management System welcomes you to our About Us page. Employment opportunities for professionals.</p>
                    <a href="#" class="text-green-500 font-semibold hover:underline">Learn more</a>
                </div>
            </div>
        </div>
    </section>



    <!-- Testimonials Section -->
    <section class="bg-blue-100 py-12">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-8 text-blue-800">What Our Users Say</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white p-6 rounded-lg shadow-lg transition-transform duration-500 hover:scale-105 animate__animated animate__fadeInUp">
                    <i class="fas fa-user-circle text-6xl text-blue-600 mb-4"></i>
                    <p class="italic">"This task manager changed the way I organize my day-to-day activities. Highly recommend!"</p>
                    <p class="font-semibold mt-4">- John Doe</p>
                </div>
                <!-- Testimonial 2 -->
                <div class="bg-white p-6 rounded-lg shadow-lg transition-transform duration-500 hover:scale-105 animate__animated animate__fadeInUp">
                    <i class="fas fa-user-circle text-6xl text-blue-600 mb-4"></i>
                    <p class="italic">"A perfect solution for my team's task management. Simple yet powerful!"</p>
                    <p class="font-semibold mt-4">- Jane Smith</p>
                </div>
                <!-- Testimonial 3 -->
                <div class="bg-white p-6 rounded-lg shadow-lg transition-transform duration-500 hover:scale-105 animate__animated animate__fadeInUp">
                    <i class="fas fa-user-circle text-6xl text-blue-600 mb-4"></i>
                    <p class="italic">"The best part is how easy it is to assign tasks and track progress. A game-changer."</p>
                    <p class="font-semibold mt-4">- Alice Brown</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black text-white py-8">
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
            <div class="text-center md:text-left">
                <p>&copy; 2024 Employee Task Management System. All rights reserved.</p>
            </div>
            <div class="flex justify-center md:justify-end gap-4 mt-4 md:mt-0">
                <a href="#" class="text-white hover:text-blue-500"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-white hover:text-blue-500"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-white hover:text-blue-500"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" class="text-white hover:text-blue-500"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>
</body>
</html>
