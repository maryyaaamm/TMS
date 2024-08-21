@extends('layouts.dashboard')

@section('content')

<div class="container my-5">
    <h2 class="text-center mb-4">Manage Your Tasks <i class="fas fa-tasks"></i></h2>

    @if(Auth::user()->hasRole('superadmin'))
        <h2 class="mb-3 text-center text-primary">All Tasks</h2>
        
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
                                <td class="text-center">{{ $task->status->name ?? 'No status' }}</td>
                                <td class="text-center">{{ $task->assignedUser->name ?? 'Not assigned' }}</td>
                                <td class="text-center">
                                    @if (!$task->document_path)
                                        <form action="{{ route('tasks.submitDocument', $task->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="file" name="document" accept=".pdf,.doc,.docx" class="form-control-file">
                                            <button type="submit" class="btn btn-primary mt-2"><i class="fas fa-upload"></i> Submit</button>
                                        </form>
                                    @else
                                        <p class="text-success"><i class="fas fa-check-circle"></i> Document Submitted</p>
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
    @else
    <div class="d-flex justify-content-end mb-3">
        <select id="statusFilter" class="form-control w-auto me-2">
            <option value="">Filter by Status</option>
            <option value="Completed">Completed</option>
            <option value="Pending">Pending</option>
            <option value="In Progress">In Progress</option>
        </select>
    </div>
    
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
        font-size: 2rem; /* Increased font size for better visibility */
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
        text-align: center; /* Center text in table headings and cells */
        border-right: 1px solid #dee2e6; /* Add border to the right of cells */
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
        padding-bottom: 50px; /* Add space below the table */
    }

    /* Custom styles for search bar */
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
        color: #28a745; /* Green color */
    }

    /* Custom styles for the table rows and columns */
    .table-row {
        border-bottom: 1px solid #dee2e6; /* Border between rows */
    }

    /* Custom styles for the "Document Submitted" status */
    .text-success {
        color: #28a745; /* Green color for success */
    }

    /* Heading icon */
    h2 i {
        margin-left: 10px;
        font-size: 1.5rem; /* Adjust icon size */
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
  var table = $('#tasksTable').DataTable({
        paging: true, 
        searching: true,
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
</script>

@endsection
