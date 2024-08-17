@extends('layouts.dashboard')
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div class="container-fluid p-0 m-0 font-roboto">
    <div class="min-h-screen flex w-full bg-[#f8f9fa]">
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
                                class="flex items-center text-white hover:text-[#007bff] hover:bg-[#495057] px-4 py-3 rounded-md text-lg transition ease-in-out duration-300 transform hover:scale-105">
                                <i class="fas fa-home mr-3"></i> Home
                            </a>
                        </li>
                    @endunless

                    @if (Auth::user()->hasRole('superadmin'))
                        <li>
                            <a href="{{ route('tasks.create') }}"
                                class="flex items-center text-white hover:text-[#007bff] hover:bg-[#495057] px-4 py-3 rounded-md text-lg transition ease-in-out duration-300 transform hover:scale-105">
                                <i class="fas fa-plus-circle mr-3"></i> Create Task
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('tasks.index') }}"
                                class="flex items-center text-white hover:text-[#007bff] hover:bg-[#495057] px-4 py-3 rounded-md text-lg transition ease-in-out duration-300 transform hover:scale-105">
                                <i class="fas fa-tasks mr-3"></i> Tasks
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center text-white hover:text-primary hover:bg-gray-700 px-4 py-3 rounded-md text-lg transition duration-300">
                                <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center text-white hover:text-primary hover:bg-gray-700 px-4 py-3 rounded-md text-lg transition duration-300">
                                <i class="fas fa-building mr-3"></i> Department
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center text-white hover:text-primary hover:bg-gray-700 px-4 py-3 rounded-md text-lg transition duration-300">
                                <i class="fas fa-user mr-3"></i> Employee
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center text-white hover:text-primary hover:bg-gray-700 px-4 py-3 rounded-md text-lg transition duration-300">
                                <i class="fas fa-tasks mr-3"></i> Task
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center text-white hover:text-primary hover:bg-gray-700 px-4 py-3 rounded-md text-lg transition duration-300">
                                <i class="fas fa-exclamation-circle mr-3"></i> Task Status
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center text-white hover:text-primary hover:bg-gray-700 px-4 py-3 rounded-md text-lg transition duration-300">
                                <i class="fas fa-search mr-3"></i> Search Employee
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center text-white hover:text-primary hover:bg-gray-700 px-4 py-3 rounded-md text-lg transition duration-300">
                                <i class="fas fa-file-alt mr-3"></i> Task Reports
                            </a>
                        </li>
        
                    @endif
                </ul>
            </div> --}}
        @section('content')

            <!-- Main Content -->
            <div class="flex-1 bg-white p-8 overflow-auto">
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-4xl text-[#212529] font-bold">Welcome, {{ Auth::user()->name }}</h1>
                </div>

                <!-- Overview Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <div
                        class="bg-gradient-to-r from-green-400 to-green-600 p-6 rounded-lg shadow-lg hover:shadow-xl transition ease-in-out duration-200 transform hover:scale-105">
                        <h3 class="text-2xl font-semibold text-white mb-2">Total Tasks</h3>
                        <p class="text-5xl text-white">{{ $tasksCount }}</p>
                    </div>
                    <div
                        class="bg-gradient-to-r from-blue-400 to-blue-600 p-6 rounded-lg shadow-lg hover:shadow-xl transition ease-in-out duration-200 transform hover:scale-105">
                        <h3 class="text-2xl font-semibold text-white mb-2">Completed Tasks</h3>
                        <p class="text-5xl text-white">{{ $completedTasksCount }}</p>
                    </div>
                    <div
                        class="bg-gradient-to-r from-red-400 to-red-600 p-6 rounded-lg shadow-lg hover:shadow-xl transition ease-in-out duration-200 transform hover:scale-105">
                        <h3 class="text-2xl font-semibold text-white mb-2">Pending Tasks</h3>
                        <p class="text-5xl text-white">{{ $pendingTasksCount }}</p>
                    </div>
                </div>

                <!-- Task Overview (Superadmin) -->
                @if (Auth::user()->hasRole('superadmin'))
                    <div
                        class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition ease-in-out duration-200 transform hover:scale-105">
                        <h3 class="text-3xl font-semibold text-[#2c3e50] mb-4">Tasks Overview</h3>
                        <table class="w-full text-[#2c3e50] border-collapse">
                            <thead>
                                <tr class="bg-[#3498db] text-white text-lg">
                                    <th class="border-b px-6 py-4 text-left font-medium">Task Title</th>
                                    <th class="border-b px-6 py-4 text-left font-medium">Status</th>
                                    <th class="border-b px-6 py-4 text-left font-medium">Assigned User</th>
                                    <th class="border-b px-6 py-4 text-left font-medium">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr class="hover:bg-[#ecf0f1]">
                                        <td class="border-b px-6 py-4 text-base">{{ $task->title }}</td>
                                        <td class="border-b px-6 py-4 text-base">
                                            @if ($task->status->name === 'submitted')
                                                <span class="bg-[#f39c12] text-white px-2 py-1 rounded-lg">In
                                                    Progress</span>
                                            @else
                                                <span
                                                    class="bg-[#2ecc71] text-white px-2 py-1 rounded-lg">{{ ucfirst($task->status->name) }}</span>
                                            @endif
                                        </td>
                                        <td class="border-b px-6 py-4 text-base">
                                            {{ $task->assignedUser ? $task->assignedUser->name : 'Not assigned' }}</td>
                                        <td class="border-b px-6 py-4 text-base flex space-x-2">
                                            <a href="{{ route('tasks.edit', $task->id) }}"
                                                class="text-[#2980b9] hover:underline">Edit</a>
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-[#e74c3c] hover:underline">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $tasks->links('pagination::tailwind') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    {{-- @endpush --}}

@endsection
