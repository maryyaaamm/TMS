@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4 font-bold text-dark-brown">My Tasks</h1>
    
    @if(Auth::user()->hasRole('superadmin'))
        <!-- Superadmin view: Display all tasks -->
        <h2 class="mb-3 text-center text-soft-pink">All Tasks</h2>
        @if ($tasks->isEmpty())
            <p class="text-center">No tasks available.</p>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="tasksTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Assigned To</th>
                            <th>Submit Document</th>
                            <th>Document</th> <!-- New column for document -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->status->name ?? 'No status' }}</td>
                                <td>{{ $task->assignedUser->name ?? 'Not assigned' }}</td>
                                <td>
                                    <form action="{{ route('tasks.submitDocument', $task->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="document" accept=".pdf,.doc,.docx" class="form-control-file">
                                        <button type="submit" class="btn btn-primary mt-2"><i class="fas fa-upload"></i> Submit Document</button>
                                    </form>
                                </td>
                                <td>
                                    @if ($task->document_path)
                                        <a href="{{ route('tasks.downloadDocument', $task->id) }}" class="btn btn-secondary"><i class="fas fa-download"></i> Download Document</a>
                                    @else
                                        Document is not uploaded
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    @else
        <!-- Regular user view: Display only assigned tasks -->
        @if ($tasks->isEmpty())
            <p class="text-center">No tasks assigned.</p>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="tasksTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Submit Document</th>
                            <th>Document</th> <!-- New column for document -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->status->name ?? 'No status' }}</td>
                                <td>
                                    @if ($task->assignedUser && $task->assignedUser->id === Auth::id())
                                        <form action="{{ route('tasks.submitDocument', $task->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="file" name="document" accept=".pdf,.doc,.docx" class="form-control-file">
                                            <button type="submit" class="btn btn-primary mt-2"><i class="fas fa-upload"></i> Submit Document</button>
                                        </form>
                                    @else
                                        <p>You are not assigned to this task.</p>
                                    @endif
                                </td>
                                <td>
                                    @if ($task->document_path)
                                        <a href="{{ route('tasks.downloadDocument', $task->id) }}" class="btn btn-secondary"><i class="fas fa-download"></i> Download Document</a>
                                    @else
                                        Document is not uploaded
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

<!-- jQuery (necessary for DataTables) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<!-- DataTables Initialization -->
<script>
    $(document).ready(function() {
        $('#tasksTable').DataTable({
            paging: true,
            searching: true,
            language: {
                search: '',
                searchPlaceholder: "Search tasks...",
            },
            dom: '<"d-flex justify-content-between align-items-center"f>t<"d-flex justify-content-between align-items-center"ip>',
        });

        // Add search icon to the search input
        $('.dataTables_filter input[type="search"]').addClass('form-control').after('<i class="fas fa-search search-icon"></i>');
    });
</script>

<style>
    /* Styling for the table and buttons */
    .table-responsive {
        margin-top: 20px;
    }
    
    .table thead th {
        background-color: #4B3832;
        color: #FAF3E0;
    }
    
    .table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    
    .table tbody tr:hover {
        background-color: #f1f1f1;
    }

    .btn-primary {
        background-color: #D4A5A5;
        border: none;
    }
    
    .btn-primary:hover {
        background-color: #F3CA20;
    }

    .btn-secondary {
        background-color: #468189;
        border: none;
    }
    
    .btn-secondary:hover {
        background-color: #356f6b;
    }

    /* Styling for the search input and icon */
    .dataTables_filter {
        position: relative;
    }
    
    .search-icon {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #888;
        pointer-events: none;
    }

    .dataTables_filter input[type="search"] {
        padding-right: 30px;
        border-radius: 20px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 5px 10px;
        margin: 0 3px;
        border-radius: 5px;
        background: #D4A5A5;
        color: #fff !important;
        text-decoration: none;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #F3CA20;
    }
</style>
@endsection
