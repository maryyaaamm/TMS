@extends('layouts.dashboard')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div class="container-fluid p-0 m-0">
    <div class="min-h-screen flex w-full bg-[#f8f9fa]">
        <!-- Sidebar -->
        <div class="text-[#ffffff] w-64 p-4 flex flex-col items-center min-w-max bg-[#343a40] shadow-lg">
            <div class="mb-8">
                <!-- Profile Picture or Logo -->
                <img src="https://th.bing.com/th/id/OIP.MAleQeDj2W5A7kkxCfLMjgHaFj?w=233&h=180&c=7&r=0&o=5&pid=1.7" alt="Logo" class="w-20 h-20 rounded-full mb-4">
            </div>
            <ul class="space-y-4 w-full">
                @unless(Auth::user()->hasRole('superadmin'))
                    <li>
                        <a href="{{ route('tasks.userTasks') }}" class="flex items-center text-[#ffffff] hover:text-[#007bff] hover:bg-[#495057] px-4 py-3 rounded-md text-lg transition ease-in-out duration-300 transform hover:scale-105">
                            <i class="fas fa-home mr-3"></i> Home
                        </a>
                    </li>
                @endunless
                
                @if(Auth::user()->hasRole('superadmin'))
                    <li>
                        <a href="{{ route('tasks.create') }}" class="flex items-center text-[#ffffff] hover:text-[#007bff] hover:bg-[#495057] px-4 py-3 rounded-md text-lg transition ease-in-out duration-300 transform hover:scale-105">
                            <i class="fas fa-plus-circle mr-3"></i> Create Task
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tasks.index') }}" class="flex items-center text-[#ffffff] hover:text-[#007bff] hover:bg-[#495057] px-4 py-3 rounded-md text-lg transition ease-in-out duration-300 transform hover:scale-105">
                            <i class="fas fa-tasks mr-3"></i> Tasks
                        </a>
                    </li>
                    {{-- <li>
                        <a href="{{ route('users.index') }}" class="flex items-center text-[#ffffff] hover:text-[#007bff] hover:bg-[#495057] px-4 py-3 rounded-md text-lg transition ease-in-out duration-300 transform hover:scale-105">
                            <i class="fas fa-users mr-3"></i> Users
                        </a>
                    </li> --}}
                @endif
            </ul>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 bg-[#f8f9fa] p-8 overflow-auto">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-4xl text-[#212529] font-bold">Welcome, {{ Auth::user()->name }}</h1>
            </div>

            <!-- Overview Cards -->
            @if(Auth::user()->hasRole('superadmin'))
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <div class="bg-[green] p-6 rounded-lg shadow-lg hover:shadow-xl transition ease-in-out duration-200 transform hover:scale-105 border border-[#ced4da]">
                        <h3 class="text-2xl font-semibold text-[white] mb-2">Total Tasks</h3>
                        <p class="text-5xl text-[#212529]">{{ $tasksCount }}</p>
                    </div>
                    <div class="bg-[#1679AB] p-6 rounded-lg shadow-lg hover:shadow-xl transition ease-in-out duration-200 transform hover:scale-105 border border-[#ced4da]">
                        <h3 class="text-2xl font-semibold text-[white] mb-2">Completed Tasks</h3>
                        <p class="text-5xl text-[#212529]">{{ $completedTasksCount }}</p>
                    </div>
                    <div class="bg-[red] p-6 rounded-lg shadow-lg hover:shadow-xl transition ease-in-out duration-200 transform hover:scale-105 border border-[#ced4da]">
                        <h3 class="text-2xl font-semibold text-[white] mb-2">Pending Tasks</h3>
                        <p class="text-5xl text-[#212529]">{{ $pendingTasksCount }}</p>
                    </div>
                    <div class="bg-[#ffffff] p-6 rounded-lg shadow-lg col-span-1 sm:col-span-2 lg:col-span-3 flex flex-col border border-[#ced4da]">
                        <h3 class="text-2xl font-semibold text-[#212529] mb-2">Submitted and In Progress Tasks</h3>
                        <div class="flex flex-col space-y-4">
                            <!-- Submitted Tasks -->
                            <div class="bg-[#ffffff] p-4 rounded-lg shadow-md border border-[#ced4da]">
                                <h4 class="text-xl font-semibold text-[#212529] mb-2">Submitted Tasks</h4>
                                <ul>
                                    @foreach($submittedTasks as $task)
                                        <li class="text-[#212529]">
                                            <input type="checkbox" checked disabled; 
                                             style="background-color: black">
                                            <span>{{ $task->title }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- In Progress Tasks -->
                            <div class="bg-[#ffffff] p-4 rounded-lg shadow-md border border-[#ced4da]">
                                <h4 class="text-xl font-semibold text-[#212529] mb-2">In Progress Tasks</h4>
                                <ul>
                                    @foreach($inProgressTasks as $task)
                                        <li class="text-[#212529]">
                                            <input type="checkbox" checked disabled;>
                                            <span>{{ $task->title }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- User-specific overview cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <div class="bg-[#ffffff] p-6 rounded-lg shadow-lg hover:shadow-xl transition ease-in-out duration-200 transform hover:scale-105 border border-[#ced4da]">
                        <h3 class="text-2xl font-semibold text-[#212529] mb-2">Total Tasks</h3>
                        <p class="text-5xl text-[#212529]">{{ $tasksCount }}</p>
                    </div>
                    <div class="bg-[#ffffff] p-6 rounded-lg shadow-lg hover:shadow-xl transition ease-in-out duration-200 transform hover:scale-105 border border-[#ced4da]">
                        <h3 class="text-2xl font-semibold text-[#212529] mb-2">Completed Tasks</h3>
                        <p class="text-5xl text-[#212529]">{{ $completedTasksCount }}</p>
                    </div>
                    <div class="bg-[#ffffff] p-6 rounded-lg shadow-lg hover:shadow-xl transition ease-in-out duration-200 transform hover:scale-105 border border-[#ced4da]">
                        <h3 class="text-2xl font-semibold text-[#212529] mb-2">Pending Tasks</h3>
                        <p class="text-5xl text-[#212529]">{{ $pendingTasksCount }}</p>
                    </div>
                </div>
            @endif

          

            <!-- Task Table -->
            <div class="bg-[#ffffff] p-6 rounded-lg shadow-lg hover:shadow-xl transition ease-in-out duration-200 transform hover:scale-105 border border-[#ced4da]">
                <h3 class="text-2xl font-semibold text-[#212529] mb-4">Tasks Overview</h3>
                <table class="w-full text-[#212529]">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">Task Title</th>
                            <th class="px-4 py-2 text-left">Status</th>
                            <th class="px-4 py-2 text-left">Assigned User</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <tr class="border-b border-[#ced4da]">
                                <td class="px-4 py-2">{{ $task->title }}</td>
                                <td class="px-4 py-2">
                                    @if (Auth::user()->hasRole('superadmin'))
                                        {{ $task->status->name === 'submitted' ? 'In Progress' : $task->status->name }}
                                    @else
                                        {{ $task->status->name ?? 'No status' }}
                                    @endif
                                </td>
                                <td class="px-4 py-2">
                                    {{ $task->assignedUser ? $task->assignedUser->name : 'Not assigned' }}
                                </td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="text-[#007bff] hover:underline">Edit</a>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">Delete</button>
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
        </div>
    </div>
</div>
@endsection
