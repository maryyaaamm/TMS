@extends('layouts.dashboard')
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
                    <h3 class="text-3xl font-semibold text-[black] mb-4">Tasks Overview</h3>
                    <table id="tasksTable" class="w-full text-[#2c3e50] border-collapse">
                        <thead>
                            <tr class="bg-[#3498db] text-white text-lg">
                                <th class="border-b px-6 py-4 text-left font-medium">Task Title</th>
                                <th class="border-b px-6 py-4 text-left font-medium">Status</th>
                                <th class="border-b px-6 py-4 text-left font-medium">Assigned User</th>
                                {{-- <th class="border-b px-6 py-4 text-left font-medium">Actions</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr class="hover:bg-[#ecf0f1] transition-all">
                                    <td class="border-b px-6 py-4 text-base">{{ $task->title }}</td>
                                    <td class="border-b px-6 py-4 text-base">
                                        @if ($task->status->name === 'submitted')
                                            <span class="bg-[#f39c12] text-white px-2 py-1 rounded-lg">In Progress</span>
                                        @else
                                            <span class="bg-[#2ecc71] text-white px-2 py-1 rounded-lg">{{ ucfirst($task->status->name) }}</span>
                                        @endif
                                    </td>
                                    <td class="border-b px-6 py-4 text-base">
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