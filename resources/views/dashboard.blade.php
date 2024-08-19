@extends('layouts.dashboard')
<style>/* Adjust styling for the DataTable search input */
    .dataTables_wrapper .dataTables_filter input {
        color: black; /* Set the text color to black */
        border: 1px solid #ccc; /* Light border */
        border-radius: 4px; /* Rounded corners */
        padding: 0.5em 1em; /* Add padding */
        font-size: 1em; /* Font size */
        margin-bottom: 1em; /* Spacing below the input */
        width: 100%; /* Full width */
        box-sizing: border-box; /* Include padding and border in width calculation */
    }
    
    /* Adjust the search label styling if needed */
    .dataTables_wrapper .dataTables_filter label {
        font-weight: 600; /* Bold text for the label */
        color: #333; /* Darker color for better contrast */
    }
    
    /* Pagination styling */
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
    </style>
@section('content')
<div class="container-fluid p-0 font-roboto">
    <div class="min-h-screen flex w-full bg-[#f8f9fa]">
        <!-- Sidebar (Hidden) -->
        
        <!-- Main Content -->
        <div class="flex-1 bg-white p-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-4xl text-[#212529] font-bold">Welcome, {{ Auth::user()->name }}</h1>
            </div>
            <!-- Overview Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <div class="bg-[#f35d32] p-6 rounded-lg shadow-lg hover:shadow-xl transition-all transform hover:scale-105">
                    <h3 class="text-2xl font-semibold text-white mb-2">Total Tasks</h3>
                    <p class="text-5xl text-white">{{ $tasksCount }}</p>
                </div>
                <div class="bg-[#e91e63] p-6 rounded-lg shadow-lg hover:shadow-xl transition-all transform hover:scale-105">
                    <h3 class="text-2xl font-semibold text-white mb-2">Pending Tasks</h3>
                    <p class="text-5xl text-white">{{ $pendingTasksCount }}</p>
                </div>
                <div class="bg-[#67CB35] p-6 rounded-lg shadow-lg hover:shadow-xl transition-all transform hover:scale-105">
                    <h3 class="text-2xl font-semibold text-white mb-2">Completed Tasks</h3>
                    <p class="text-5xl text-white">{{ $completedTasksCount }}</p>
                </div>
            </div>

            <!-- Task Overview (Superadmin) -->
            @if (Auth::user()->hasRole('superadmin'))
                <div class="bg-white p-6 rounded-lg shadow-lg transition hover:shadow-xl">
                    <h3 class="text-3xl font-semibold text-[#212529] mb-4">Tasks Overview</h3>
                    <table id="tasksTable" class="w-full text-[#2c3e50] border-collapse border border-gray-200 rounded-lg overflow-hidden">
                        <thead>
                            <tr class="bg-[#3498db] text-white text-lg">
                                <th class="border-b px-6 py-4 text-center font-medium">Task Title</th>
                                <th class="border-b px-6 py-4 text-center font-medium">Status</th>
                                <th class="border-b px-6 py-4 text-center font-medium">Assigned User</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr class="hover:bg-[#ecf0f1] transition-all text-center">
                                    <td class="border-b px-6 py-4">{{ $task->title }}</td>
                                    <td class="px-4 py-3 border-b border-gray-300">
                                        @if($task->status_id == 4)
                                            <span class="bg-green-200 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Completed</span>
                                        @elseif($task->status_id == 2)
                                            <span class="bg-blue-200 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">Submitted</span>
                                        @else
                                            <span class="bg-red-200 text-red-800 px-3 py-1 rounded-full text-xs font-semibold">Pending</span>
                                        @endif
                                    </td>
                                    <td class="border-b px-6 py-4">
                                        {{ $task->assignedUser ? $task->assignedUser->name : 'Not assigned' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#tasksTable').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "pageLength": 10,
        "dom": '<"top"f>rt<"bottom"p><"clear">',
        "language": {
            "search": "_INPUT_",
            "searchPlaceholder": "Search tasks..."
        },
        "columnDefs": [
            { "orderable": false, "targets": [1, 2] }
        ]
    });
});
</script>
@endpush
