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
                                    <td class="text-center">
                                        @if ($task->assignedUser && $task->assignedUser->id === Auth::id())
                                            @if (!$task->document_path)
                                                <form action="{{ route('tasks.submitDocument', $task->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="file" name="document" accept=".pdf,.doc,.docx"
                                                        class="form-control-file">
                                                    <button type="submit" class="btn btn-primary mt-2"><i
                                                            class="fas fa-upload"></i> Submit</button>
                                                </form>
                                            @else
                                                <p class="text-success"><i class="fas fa-check-circle"></i> Document
                                                    Submitted</p>
                                            @endif
                                        @else
                                            <p>You are not assigned to this task.</p>
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
                                        <button id="startTracking-{{ $task->id }}"
                                            class="btn btn-success start-tracking-btn">Start Tracking</button>
                                        <button id="stopTracking-{{ $task->id }}"
                                            class="btn btn-danger stop-tracking-btn" disabled>Stop Tracking</button>
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
    let totalTimes = {}; // Store total time spent in a persistent object

    const updateInterval = 1000; // Update every 1000 milliseconds (1 second)

    // Load stored start times and total times from local storage
    if (localStorage.getItem('startTimes')) {
        startTimes = JSON.parse(localStorage.getItem('startTimes'));
    }

    if (localStorage.getItem('totalTimes')) {
        totalTimes = JSON.parse(localStorage.getItem('totalTimes'));
    }

    // Start tracking time
    document.querySelectorAll('.start-tracking-btn').forEach(button => {
        button.addEventListener('click', function() {
            const taskId = this.id.split('-')[1];
            if (startTimes[taskId]) return; // Avoid starting a new interval if one is already running

            startTimes[taskId] = new Date().getTime(); // Store start time as a timestamp
            localStorage.setItem('startTimes', JSON.stringify(startTimes)); // Save to local storage

            intervals[taskId] = setInterval(() => updateTimeDisplay(taskId), updateInterval); // Start updating with setInterval
            document.getElementById('stopTracking-' + taskId).disabled = false;
            this.disabled = true;
        });
    });

    // Stop tracking time
    document.querySelectorAll('.stop-tracking-btn').forEach(button => {
        button.addEventListener('click', function() {
            const taskId = this.id.split('-')[1];
            stopTracking(taskId);
        });
    });

    function updateTimeDisplay(taskId) {
        if (!startTimes[taskId]) return; // If no start time, exit the function

        const now = new Date().getTime();
        const startTime = startTimes[taskId];
        const elapsedTime = Math.floor((now - startTime) / 1000); // Time in seconds

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

    function stopTracking(taskId) {
        if (!startTimes[taskId]) return; // No start time found, exit the function

        clearInterval(intervals[taskId]); // Stop the interval

        const now = new Date().getTime();
        const startTime = startTimes[taskId];
        const elapsedTime = Math.floor((now - startTime) / 1000); // Time in seconds

        const previousTime = totalTimes[taskId] || 0;
        const totalTime = previousTime + elapsedTime;
        totalTimes[taskId] = totalTime; // Save total time spent
        localStorage.setItem('totalTimes', JSON.stringify(totalTimes)); // Save to local storage

        const timeSpentCell = document.querySelector(`#tasksTable tbody tr td.time-spent[data-task-id="${taskId}"]`);
        if (timeSpentCell) {
            timeSpentCell.setAttribute('data-time', totalTime);
            timeSpentCell.textContent = formatTime(totalTime);
        }

        // Save time to the database
        saveTimeToDatabase(totalTime, taskId);

        // Reset start time and interval
        delete startTimes[taskId];
        delete intervals[taskId];
        localStorage.setItem('startTimes', JSON.stringify(startTimes)); // Update local storage

        document.getElementById('startTracking-' + taskId).disabled = false;
        document.getElementById('stopTracking-' + taskId).disabled = true;
    }

    // Save time to the database
    function saveTimeToDatabase(time, taskId) {
        return $.ajax({
            url: '{{ url('/tasks/track-time') }}/' + taskId,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                total_time: time,
            }
        });
    }

    // Check if there's any active tracking session on page load
    document.addEventListener('DOMContentLoaded', function() {
        Object.keys(startTimes).forEach(taskId => {
            if (startTimes[taskId]) {
                intervals[taskId] = setInterval(() => updateTimeDisplay(taskId), updateInterval);
                document.getElementById('startTracking-' + taskId).disabled = true;
                document.getElementById('stopTracking-' + taskId).disabled = false;
            }
        });
    });

    // Stop tracking time when the form is submitted
    document.querySelector('form').addEventListener('submit', function(event) {
        Object.keys(startTimes).forEach(taskId => {
            if (startTimes[taskId]) {
                stopTracking(taskId); // Stop tracking for all active sessions
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
