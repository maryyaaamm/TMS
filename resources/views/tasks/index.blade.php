@extends('layouts.dashboard')

@section('content')

<div class="container my-5">
    <h2 class="text-center mb-4">Manage Users Tasks <i class="fas fa-tasks"></i></h2>

    @if(Auth::user()->hasRole('superadmin'))
        <!-- Status Filter Dropdown -->
        <div class="d-flex justify-content-end mb-3">
            <select id="statusFilter" class="form-control w-auto me-2">
                <option value="">Filter by Status</option>
                <option value="Completed">Completed</option>
                <option value="Pending">Pending</option>
                <option value="In Progress">In Progress</option>
            </select>
        </div>
        
        @if ($tasks->isEmpty())
            <p class="text-center">No tasks available.</p>
        @else
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tasksTable">
                    <thead class="table-header">
                        <tr>
                            <th class="text-center">Title</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Assigned To</th>
                            <th class="text-center">Submit Document</th>
                            <th class="text-center">Document</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr class="table-row">
                                <td class="text-center">{{ $task->title }}</td>
                                <td class="text-center">
                                    @if (Auth::user()->hasRole('superadmin'))
                                        {{ $task->status->name === 'submitted' ? 'In Progress' : $task->status->name }}
                                    @else
                                        {{ $task->status->name ?? 'No status' }}
                                    @endif
                                </td>
                                <td class="text-center">{{ $task->assignedUser->name ?? 'Not assigned' }}</td>
                                <td class="px-6 py-4 border-b border-gray-300">
                                    <a href="{{ route('tasks.edit', $task->id) }}"
                                        class="inline-block px-4 py-2 bg-gray-700 text-white rounded-full transition-all hover:bg-gray-800 mr-2 task-assign-btn"
                                        id="task-assign-btn-{{ $task->id }}">
                                        <i class="fas fa-edit"></i> 
                                        @if($task->assignedUser)
                                            Assigned
                                        @else
                                            Assign Tasks
                                        @endif
                                    </a>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-4 py-2 bg-red-600 text-white rounded-full transition-all hover:bg-red-700">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </td>
        
                                <td class="text-center">
                                    @if ($task->document_path)
                                        <a href="{{ route('tasks.downloadDocument', $task->id) }}" class="btn btn-secondary"><i class="fas fa-download"></i> Download</a>
                                    @else
                                        Not Uploaded
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    @else
        @if ($tasks->isEmpty())
            <p class="text-center">No tasks assigned.</p>
        @else
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tasksTable">
                    <thead class="table-header">
                        <tr>
                            <th class="text-center">Title</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Submit Document</th>
                            <th class="text-center">Document</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr class="table-row">
                                <td class="text-center">{{ $task->title }}</td>
                                <td class="text-center">{{ $task->status->name ?? 'No status' }}</td>
                                <td class="text-center">
                                    @if ($task->assignedUser && $task->assignedUser->id === Auth::id())
                                        @if (!$task->document_path)
                                            <form action="{{ route('tasks.submitDocument', $task->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="file" name="document" accept=".pdf,.doc,.docx" class="form-control-file">
                                                <button type="submit" class="btn btn-primary mt-2"><i class="fas fa-upload"></i> Submit</button>
                                            </form>
                                        @else
                                            <p class="text-success"><i class="fas fa-check-circle"></i> Document Submitted</p>
                                        @endif
                                    @else
                                        @if ($task->assignedUser && $task->assignedUser->id !== Auth::id())
                                            <p>You are not assigned to this task.</p>
                                        @endif
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($task->document_path)
                                        <a href="{{ route('tasks.downloadDocument', $task->id) }}" class="btn btn-secondary"><i class="fas fa-download"></i> Download</a>
                                    @else
                                        Not Uploaded
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    @endif
</div>
<!-- Custom CSS -->
<style>
    body {
        background-color: #f8f9fa;
        color: #333;
    }

    h2 {
        color: #0056b3;
        font-weight: bold;
        font-size: 2rem;
    }

    .table {
        margin-top: 20px;
        background-color: #ffffff;
        border: 1px solid #dee2e6;
        border-radius: 8px;
    }

    .table-header {
        background-color: #0056b3;
        color: #ffffff;
    }

    .table-hover tbody tr:hover {
        background-color: #e9ecef;
    }

    th, td {
        padding: 12px;
        text-align: center;
        border-right: 1px solid #dee2e6;
    }

    th {
        font-weight: bold;
    }

    td {
        color: #0056b3;
    }

    .btn-primary {
        background-color: #0056b3;
        border: none;
        color: #ffffff;
    }

    .btn-primary:hover {
        background-color: #004085;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
        color: #ffffff;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .form-control-file {
        border: 1px solid #ced4da;
        border-radius: 4px;
    }

    .container {
        padding-bottom: 50px;
        color: #dee2e6
    }

    .dataTables_filter {
        position: relative;
        margin-bottom: 20px;
    }

    .dataTables_filter input {
        border-radius: 50px;
        border: 1px solid #ced4da;
        padding: 10px 40px 10px 20px;
        width: 300px;
    }

    .dataTables_filter .search-icon {
        position: absolute;
        top: 8px;
        right: 15px;
        font-size: 20px;
        color: #28a745;
    }

    .table-row {
        border-bottom: 1px solid #dee2e6;
    }

    .text-success {
        color: #28a745;
    }

    h2 i {
        margin-left: 10px;
        font-size: 1.5rem;
    }
</style>

<!-- jQuery (necessary for DataTables) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<!-- DataTables Initialization -->
<script>
$(document).ready(function() {
    var table = $('#tasksTable').DataTable({
        paging: true, 
        searching: true,
        order: [[0, 'desc']], // This will sort the first column (Title) in descending order by default
        language: {
            search: '',
            searchPlaceholder: "Search tasks...",
        },
        dom: '<"d-flex justify-content-between align-items-center"f>t<"d-flex justify-content-between align-items-center"ip>',
    });

    $('.dataTables_filter input[type="search"]').addClass('form-control').after('<i class="fas fa-search search-icon"></i>');

    // Filter by status
    $('#statusFilter').on('change', function() {
        var status = $(this).val();
        if (status) {
            table.column(1).search(status).draw(); // Assuming status is in the second column (index 1)
        } else {
            table.column(1).search('').draw(); // Reset the filter
        }
    });
});


</script>

@endsection
