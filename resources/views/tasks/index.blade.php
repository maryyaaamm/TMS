@extends('layouts.task')

@section('content')
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            background-color: #fff;
        }

        th, td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f3f3f3; /* Light gray for header background */
            font-weight: bold;
            color: black; /* Ensures the header text is black */
        }

        tr:hover {
            background-color: #f5f5f5; /* Light gray for hover effect */
        }

        .search-form input[type="text"] {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 20px; /* Makes the search bar rounded */
            width: 100%;
            max-width: 300px;
            margin-right: 8px;
            color: black; /* Ensures text is visible */
            font-weight: bold; /* Makes the text bold */
        }

        .search-form button {
            padding: 8px 16px;
            background-color: #000;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .search-form button:hover {
            background-color: #333;
        }

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
            color: black; /* Ensures the text in the search bar is black */
            font-weight: bold; /* Makes the search text bold */
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

    <div class="max-w-6xl mx-auto p-6 bg-gray-100 rounded-lg shadow-lg font-sans">
        <h1 class="text-center text-black font-bold text-3xl mb-6">
            <i class="fas fa-tasks"></i> Tasks
        </h1>

        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('tasks.create') }}"
                class="inline-block px-6 py-2 bg-black text-white font-bold rounded-full transition-all hover:bg-gray-800">
                <i class="fas fa-plus-circle"></i> Create Task
            </a>

            <!-- Search Form -->
            <form action="{{ route('tasks.index') }}" method="GET" class="search-form flex">
                <input type="text" name="search" placeholder="Search tasks..." value="{{ request('search') }}">
                <button type="submit"><i class="fas fa-search"></i> Search</button>
            </form>
        </div>

        <table id="tasksTable" class="w-full bg-white border border-gray-300 rounded-lg overflow-hidden">
            <thead class="bg-gray-200 text-black">
                <tr>
                    <th class="px-6 py-3 text-left border-b border-gray-300 font-semibold">
                        <i class="fas fa-heading"></i> Title
                    </th>
                    <th class="px-6 py-3 text-left border-b border-gray-300 font-semibold">
                        <i class="fas fa-info-circle"></i> Status
                    </th>
                    <th class="px-6 py-3 text-left border-b border-gray-300 font-semibold">
                        <i class="fas fa-user"></i> Assigned To
                    </th>
                    <th class="px-6 py-3 text-left border-b border-gray-300 font-semibold">
                        <i class="fas fa-cogs"></i> Actions
                    </th>
                    <th class="px-6 py-3 text-left border-b border-gray-300 font-semibold">
                        <i class="fas fa-file-download"></i> Document
                    </th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach ($tasks as $task)
                    <tr class="hover:bg-gray-100 transition-colors">
                        <td class="px-6 py-4 border-b border-gray-300">{{ $task->title }}</td>
                        <td class="px-6 py-4 border-b border-gray-300">
                            {{-- Superadmin sees "In Progress" for submitted tasks, others see actual status --}}
                            @if (Auth::user()->hasRole('superadmin'))
                                {{ $task->status->name === 'submitted' ? 'In Progress' : $task->status->name }}
                            @else
                                {{ $task->status->name ?? 'No status' }}
                            @endif
                        </td>
                        <td class="px-6 py-4 border-b border-gray-300">
                            {{ $task->assignedUser ? $task->assignedUser->name : 'Not assigned' }}
                        </td>
                        <td class="px-6 py-4 border-b border-gray-300">
                            <a href="{{ route('tasks.edit', $task->id) }}"
                                class="inline-block px-4 py-2 bg-gray-700 text-white rounded-full transition-all hover:bg-gray-800 mr-2">
                                <i class="fas fa-edit"></i> Edit
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
                        <td class="px-6 py-4 border-b border-gray-300">
                            @if ($task->document_path)
                                <a href="{{ route('tasks.downloadDocument', $task->id) }}"
                                    class="inline-block px-4 py-2 bg-gray-500 text-white rounded-full transition-all hover:bg-gray-600">
                                    <i class="fas fa-download"></i> Download Document
                                </a>
                            @else
                                <span class="text-gray-500"><i class="fas fa-exclamation-circle"></i> Document is not uploaded</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6">
            {{ $tasks->links() }}
        </div>
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
@endsection
