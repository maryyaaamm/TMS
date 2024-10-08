@extends('layouts.dashboard')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white rounded-lg shadow-lg min-h-screen flex flex-col">
    <div class="mb-6">
        <h1 class="text-center text-blue-700 text-3xl font-semibold mb-6">
            <i class="fas fa-user mr-2"></i> User Details
        </h1>
        {{-- <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-blue-700 text-2xl font-semibold mb-4">User Information</h2>
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Roles:</strong> 
                @foreach($user->roles as $role) 
                    {{ $role->name }}@if(!$loop->last), @endif
                @endforeach
            </p>
            <p><strong>Present Status:</strong> 
                @if($presentStatus === 'Active')
                    <span class="bg-green-200 text-green-800 px-2 py-1 rounded-full text-xs">Active</span>
                @else
                    <span class="bg-red-200 text-red-800 px-2 py-1 rounded-full text-xs">Inactive</span>
                @endif
            </p>
        </div> --}}

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="overflow-x-auto">
                <table id="assignedTasksTable" class="w-full bg-white border border-gray-300 rounded-lg shadow-sm">
                    <thead class="bg-blue-200 text-blue-700 text-sm uppercase">
                        <tr>
                            <th class="px-4 py-3 border-b border-gray-300 font-medium text-left">Task Name</th>
                            <th class="px-4 py-3 border-b border-gray-300 font-medium text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm">
                        @forelse($user->tasksAssigned as $task)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3 border-b border-gray-300">{{ $task->title }}</td>
                                <td class="px-4 py-3 border-b border-gray-300">
                                    @if($task->status_id == 4)
                                        <span class="bg-green-200 text-green-800 px-2 py-1 rounded-full text-xs">Completed</span>
                                    @elseif($task->status_id == 2)
                                        <span class="bg-blue-200 text-blue-800 px-2 py-1 rounded-full text-xs">Submitted</span>
                                    @else
                                        <span class="bg-red-200 text-red-800 px-2 py-1 rounded-full text-xs">Pending</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="px-4 py-3 border-b border-gray-300 text-center">No tasks assigned.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        if (!$.fn.DataTable.isDataTable('#assignedTasksTable')) {
            $('#assignedTasksTable').DataTable({
                "paging": true, // Enable pagination
                "lengthChange": false, // Disable changing the number of records per page
                "searching": true, // Enable the search bar
                "ordering": true, // Enable sorting
                "info": true, // Show information text
                "autoWidth": false, // Disable auto width calculation
                "pageLength": 10, // Set the default number of records per page
                "dom": '<"top"f>rt<"bottom"p><"clear">', // Customize the layout
                "language": {
                    "search": "_INPUT_", // Customize the search input
                    "searchPlaceholder": "Search tasks...", // Add a placeholder
                },
                "columnDefs": [
                    { "orderable": false, "targets": [1] } // Disable ordering on the Status column
                ]
            });
        }
    });
</script>
@endpush
