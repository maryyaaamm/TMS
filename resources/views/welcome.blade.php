@extends('layouts.welcome')

@section('content')
    <!-- Welcome Content -->
    <div class="min-h-screen flex flex-col justify-center items-center bg-light-beige text-dark-brown relative overflow-hidden">
        <!-- Background Image -->
        {{-- <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1496715976403-7e36dc43f17b?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fHRhc2slMjBtYW5nZW1udCUyMHN5c3RlbSUyMGJhY2tncm91bmQlMjBpbWFnZXxlbnwwfHwwfHx8MA%3D%3D" alt="Background Image" class="object-cover w-full h-full opacity-40" />
        </div> --}}

        <!-- Content Box -->
        <div class="relative bg-white p-8 rounded-lg shadow-lg max-w-lg w-full z-10 text-center transform transition-transform duration-500 hover:scale-105">
            <h1 class="text-5xl font-bold text-soft-pink mb-6 animate__animated animate__fadeIn animate__delay-1s">Welcome to the Task Management System</h1>
            <p class="text-xl mb-8 animate__animated animate__fadeIn animate__delay-2s">Manage your tasks effectively and efficiently with our simple and easy-to-use interface.</p>
            
        </div>
    </div>
@endsection
