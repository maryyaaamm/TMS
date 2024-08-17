@extends('layouts.dashboard')
    
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create Task</title>

        <!-- Include Tailwind CSS and JS with Vite -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="bg-gray-100 font-sans">
        <div class="flex min-h-screen">
            <!-- Sidebar -->
            {{-- <div class="text-white w-64 p-4 flex flex-col items-center min-w-max bg-[#343a40] shadow-lg">
                <div class="mb-8">
                    <!-- Profile Picture or Logo -->
                    <img src="https://th.bing.com/th/id/OIP.MAleQeDj2W5A7kkxCfLMjgHaFj?w=233&h=180&c=7&r=0&o=5&pid=1.7"
                        alt="Logo" class="w-20 h-20 rounded-full mb-4">
                </div>
                <ul class="space-y-4 w-full">
                    @unless (Auth::user()->hasRole('superadmin'))
                        <li>
                            <a href="{{ route('tasks.userTasks') }}"
                                class="flex items-center text-black hover:text-[#007bff] hover:bg-[#495057] px-4 py-3 rounded-md text-lg transition ease-in-out duration-300 transform hover:scale-105">
                                <i class="fas fa-home mr-3"></i> Home
                            </a>
                        </li>
                    @endunless

                    @if (Auth::user()->hasRole('superadmin'))
                        <li>
                            <a href="{{ route('tasks.create') }}"
                                class="flex items-center text-white hover:text-[blue] hover:bg-[#495057] px-4 py-3 rounded-md text-lg transition ease-in-out duration-300 transform hover:scale-105">
                                <i class="fas fa-plus-circle mr-3"></i> Create Task
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('tasks.index') }}"
                                class="flex items-center text-white hover:text-[#007bff] hover:bg-[#495057] px-4 py-3 rounded-md text-lg transition ease-in-out duration-300 transform hover:scale-105">
                                <i class="fas fa-tasks mr-3"></i> Tasks
                            </a>
                        </li>
                    @endif
                </ul>
            </div> --}}
            @section('content')

            <!-- Main Content -->
            <div class="flex-1 bg-gray-50 p-10 overflow-auto flex flex-col items-center">
                <!-- Page Title -->
                <div class="flex justify-center items-center w-full mb-6">
                    <h1 class="text-3xl font-bold text-gray-900" style="padding: 20px 0;">
                        <i class="fas fa-plus-circle mr-2 text-blue-500"></i> Create Task
                    </h1>
                </div>

                <!-- Form Container -->
                <div class="w-full max-w-lg bg-white p-8 rounded-lg shadow-lg">
                    <!-- Create Task Form -->
                    <form action="{{ route('tasks.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <!-- Task Title -->
                        <div class="flex items-center">
                            <i class="fas fa-pencil-alt text-gray-500 mr-3"></i>
                            <label for="title" class="block text-lg font-medium text-black mb-2">Title</label>
                        </div>
                        <input type="text" id="title" name="title" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-black">

                        <!-- Task Description -->
                        <div class="flex items-center mt-4">
                            <i class="fas fa-align-left text-gray-500 mr-3"></i>
                            <label for="description" class="block text-lg font-medium text-black mb-2">Description</label>
                        </div>
                        <textarea id="description" name="description" required rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-black"></textarea>

                        <!-- Task Status -->
                        <div class="flex items-center mt-4">
                            <i class="fas fa-list-alt text-gray-500 mr-3"></i>
                            <label for="status" class="block text-lg font-medium text-black mb-2">Status</label>
                        </div>
                        <select id="status" name="status_id" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-black">
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endforeach
                        </select>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit"
                                class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 transition ease-in-out duration-200">
                                <i class="fas fa-check-circle mr-2"></i> Create Task
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>

    </html>
@endsection
