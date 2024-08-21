@extends('layouts.welcome')

@section('content')
    <!-- Welcome Content -->
    <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 relative overflow-hidden font-roboto">
        
        <!-- Hero Section -->
        <div class="relative bg-white bg-opacity-90 p-12 rounded-lg shadow-lg max-w-2xl w-full z-10 text-center transform transition-transform duration-500 hover:scale-105 animate__animated animate__fadeIn">
            <h1 class="text-5xl font-extrabold text-blue-600 mb-6 animate__animated animate__bounceInLeft">Welcome to the Task Management System</h1>
            <p class="text-lg mb-8 animate__animated animate__fadeInUp">Manage your tasks effectively and efficiently with our simple and easy-to-use interface.</p>
            <a href="{{ route('register') }}" class="inline-block px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-lg hover:bg-blue-500 transition duration-300 transform hover:scale-105 animate__animated animate__fadeInRight">Get Started</a>
        </div>

        <!-- Features Section -->
        <div class="mt-16 max-w-4xl w-full text-center px-6">
            <h2 class="text-3xl font-extrabold text-blue-800 mb-8">Why Choose Us?</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 animate__animated animate__fadeInUp">
                <!-- Feature 1 -->
                <div class="bg-white bg-opacity-80 p-6 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-500">
                    <i class="fas fa-tasks text-4xl text-blue-500 mb-4"></i>
                    <h3 class="text-xl font-bold mb-2">Task Management</h3>
                    <p>Easily assign and manage tasks for yourself and your team members.</p>
                </div>
                <!-- Feature 2 -->
                <div class="bg-white bg-opacity-80 p-6 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-500">
                    <i class="fas fa-chart-line text-4xl text-blue-500 mb-4"></i>
                    <h3 class="text-xl font-bold mb-2">Track Progress</h3>
                    <p>Monitor task progress in real-time and stay on top of deadlines.</p>
                </div>
                <!-- Feature 3 -->
                <div class="bg-white bg-opacity-80 p-6 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-500">
                    <i class="fas fa-users text-4xl text-blue-500 mb-4"></i>
                    <h3 class="text-xl font-bold mb-2">Team Collaboration</h3>
                    <p>Collaborate seamlessly with your team and ensure smooth project flow.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
