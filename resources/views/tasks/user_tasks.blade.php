@extends('layouts.dashboard')

@section('content')
    <div class="container my-5">
        {{-- <h2 class="text-center mb-4">Manage Your Tasks <i class="fas fa-tasks"></i></h2> --}}

        @if (Auth::user()->hasRole('superadmin'))
            <h2 class="mb-3 text-center text-primary">All Tasks</h2>

            <!-- Status Filter Dropdown -->
            <div class="d-flex justify-content-end mb-3">
                <select id="statusFilter" class="form-control w-auto me-2">
                    <option value="">Filter by Status</option>
                    <option value="Completed">Completed</option>
                    <option value="Pending">Pending</option>
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
                                <th class="text-center">Total Time Spent (Hours:Minutes:Seconds)</th>
                                <th class="text-center">Time Tracking</th>
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
                                            <form action="{{ route('tasks.submitDocument', $task->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="file" name="document" accept=".pdf,.doc,.docx"
                                                    class="form-control-file">
                                                <button type="submit" class="btn btn-primary mt-2"><i
                                                        class="fas fa-upload"></i> Submit</button>
                                            </form>
                                        @else
                                            <p class="text-success"><i class="fas fa-check-circle"></i> Document Submitted
                                            </p>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($task->document_path)
                                            <a href="{{ route('tasks.downloadDocument', $task->id) }}"
                                                class="btn btn-secondary"><i class="fas fa-download"></i> Download</a>
                                        @else
                                            Not Uploaded
                                        @endif
                                    </td>
                                    <td class="text-center time-spent" data-time="0">
                                        {{ gmdate('H:i:s', 0) }} <!-- Initial total_time -->
                                    </td>
                                    <td class="text-center">
                                        <button id="startTracking-{{ $task->id }}"
                                            class="btn btn-success start-tracking-btn">Start Tracking</button>
                                        <button id="stopTracking-{{ $task->id }}"
                                            class="btn btn-danger stop-tracking-btn" disabled>Stop Tracking</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        @else
            <h2 class="text-center mb-4">Manage Your Tasks <i class="fas fa-tasks"></i></h2>

            <div class="d-flex justify-content-end mb-3">
                <select id="statusFilter" class="form-control w-auto me-2">
                    <option value="">Filter by Status</option>
                    <option value="Completed">Completed</option>
                    <option value="Pending">Pending</option>
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
                                <th class="text-center">Total Time Spent (Hours:Minutes:Seconds)</th>
                                <th class="text-center">Time Tracking</th>
                                <th class="text-center">Total Time (Database)</th> <!-- New column -->

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr class="table-row">
                                    <td class="text-center">{{ $task->title }}</td>
                                    <td class="text-center">{{ $task->status->name ?? 'No status' }}</td>
                                    <td class="text-center" style="padding: 15px; vertical-align: middle; width: 400px;"> <!-- Adjust width as needed -->
                                        @if ($task->assignedUser && $task->assignedUser->id === Auth::id())
                                            @if (!$task->document_path)
                                                <form action="{{ route('tasks.submitDocument', $task->id) }}" method="POST" enctype="multipart/form-data" style="display: flex; align-items: center; gap: 10px;">
                                                    @csrf
                                                    <input type="file" name="document" accept=".pdf,.doc,.docx" class="form-control-file" style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; flex: 1;">
                                                    <button type="submit" class="btn btn-primary" style="padding: 8px 15px; font-weight: bold; display: flex; align-items: center;">
                                                        <i class="fas fa-paper-plane" style="margin-right: 5px;"></i> Submit
                                                    </button>
                                                </form>
                                            @else
                                                <p class="text-success" style="margin: 0; padding: 10px; font-weight: bold; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fas fa-check-circle" style="margin-right: 5px;"></i> Document Submitted
                                                </p>
                                            @endif
                                        @else
                                            <p style="margin: 0; padding: 10px; color: #555;">You are not assigned to this task.</p>
                                        @endif
                                    </td>
                                    
                                    <td class="text-center">
                                        @if ($task->document_path)
                                            <a href="{{ route('tasks.downloadDocument', $task->id) }}"
                                                class="btn btn-secondary"><i class="fas fa-download"></i> Download</a>
                                        @else
                                            Not Uploaded
                                        @endif
                                    </td>
                                    <td class="text-center time-spent" data-time="0" data-task-id="{{ $task->id }}">
                                        {{ gmdate('H:i:s', 0) }} <!-- Initial total_time -->
                                    </td>

                                    <td class="text-center">
                                        <button id="trackingButton-{{ $task->id }}"
                                            class="btn btn-success tracking-btn" data-tracking="false">
                                            Start Tracking
                                        </button>
                                    </td>

                                    <td class="text-center">
                                        {{ gmdate('H:i:s', $task->total_time) }} <!-- Total time from the database -->
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        @endif
    </div>
    <style>
        body {
            background-color: #f8f9fa;
            color: #333;
        }

        h2 {
            color: #0056b3;
            font-weight: bold;
            font-size: 2rem;
            /* Increased font size for better visibility */
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

        th,
        td {
            padding: 12px;
            text-align: center;
            /* Center text in table headings and cells */
            border-right: 1px solid #dee2e6;
            /* Add border to the right of cells */
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
            /* Add space below the table */
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
            color: #28a745;
            /* Green color */
        }

        /* Custom styles for the table rows and columns */
        .table-row {
            border-bottom: 1px solid #dee2e6;
            /* Border between rows */
        }

        /* Custom styles for the "Document Submitted" status */
        .text-success {
            color: #28a745;
            /* Green color for success */
        }

        /* Heading icon */
        h2 i {
            margin-left: 10px;
            font-size: 1.5rem;
            /* Adjust icon size */
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <script>
        let startTimes = {};
        let intervals = {};
        let totalTimes = {}; // Store the total time from the database
    
        const updateInterval = 1000;
    
        // Retrieve stored values from localStorage if available
        if (localStorage.getItem('startTimes')) {
            startTimes = JSON.parse(localStorage.getItem('startTimes'));
        }
    
        if (localStorage.getItem('totalTimes')) {
            totalTimes = JSON.parse(localStorage.getItem('totalTimes'));
        }
    
        document.querySelectorAll('.tracking-btn').forEach(button => {
            button.addEventListener('click', function() {
                const taskId = this.id.split('-')[1];
                if (!startTimes[taskId]) {
                    startTracking(taskId, this);
                } else {
                    stopTracking(taskId, this);
                }
            });
        });
    
        function startTracking(taskId, button) {
            startTimes[taskId] = new Date().getTime();
            localStorage.setItem('startTimes', JSON.stringify(startTimes));
    
            intervals[taskId] = setInterval(() => updateTimeDisplay(taskId), updateInterval);
    
            button.textContent = 'Stop Tracking';
            button.classList.remove('btn-success');
            button.classList.add('btn-danger');
        }
    
        function stopTracking(taskId, button) {
            clearInterval(intervals[taskId]);
    
            const now = new Date().getTime();
            const startTime = startTimes[taskId];
            const sessionTime = Math.floor((now - startTime) / 1000); // Time for the current session
    
            const previousTime = totalTimes[taskId] || 0;
            const totalTime = previousTime + sessionTime; // Correctly add session time to the previous total
            totalTimes[taskId] = totalTime;
            localStorage.setItem('totalTimes', JSON.stringify(totalTimes));
    
            const timeSpentCell = document.querySelector(`#tasksTable tbody tr td.time-spent[data-task-id="${taskId}"]`);
            if (timeSpentCell) {
                timeSpentCell.setAttribute('data-time', totalTime);
                timeSpentCell.textContent = formatTime(totalTime);
            }
    
            saveSessionTimeToDatabase(sessionTime, taskId);
    
            delete startTimes[taskId];
            delete intervals[taskId];
            localStorage.setItem('startTimes', JSON.stringify(startTimes));
    
            button.textContent = 'Start Tracking';
            button.classList.remove('btn-danger');
            button.classList.add('btn-success');
        }
    
        function updateTimeDisplay(taskId) {
            if (!startTimes[taskId]) return;
    
            const now = new Date().getTime();
            const startTime = startTimes[taskId];
            const elapsedTime = Math.floor((now - startTime) / 1000);
    
            const previousTime = totalTimes[taskId] || 0;
            const totalTime = previousTime + elapsedTime;
    
            const timeSpentCell = document.querySelector(`#tasksTable tbody tr td.time-spent[data-task-id="${taskId}"]`);
            if (timeSpentCell) {
                timeSpentCell.setAttribute('data-time', totalTime);
                timeSpentCell.textContent = formatTime(totalTime);
            }
        }
    
        function formatTime(seconds) {
            const hours = Math.floor(seconds / 3600);
            const minutes = Math.floor((seconds % 3600) / 60);
            const secs = seconds % 60;
            return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
        }
    
        function saveSessionTimeToDatabase(sessionTime, taskId) {
            return $.ajax({
                url: '{{ url('/tasks/track-time') }}/' + taskId,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    session_time: sessionTime,
                }
            });
        }
    
        document.addEventListener('DOMContentLoaded', function() {
            Object.keys(startTimes).forEach(taskId => {
                if (startTimes[taskId]) {
                    intervals[taskId] = setInterval(() => updateTimeDisplay(taskId), updateInterval);
                    const button = document.getElementById('trackingButton-' + taskId);
                    button.textContent = 'Stop Tracking';
                    button.classList.remove('btn-success');
                    button.classList.add('btn-danger');
                }
            });
        });
    
        document.querySelector('form').addEventListener('submit', function(event) {
            Object.keys(startTimes).forEach(taskId => {
                if (startTimes[taskId]) {
                    stopTracking(taskId, document.getElementById('trackingButton-' + taskId));
                }
            });
        });
    </script>
    
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            var table = $('#tasksTable').DataTable({
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
                "columnDefs": [{
                    "orderable": false,
                    "targets": [2, 3]
                }]
            });

            // Custom status filter
            $('#statusFilter').on('change', function() {
                var filterValue = $(this).val();
                table.column(1).search(filterValue).draw();
            });
        });
    </script>
@endpush
