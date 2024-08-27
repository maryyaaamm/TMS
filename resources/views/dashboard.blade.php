@extends('layouts.dashboard')

<style>
    /* DataTable Search Input */
    .dataTables_wrapper .dataTables_filter input {
        color: #333;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 0.5em 1em;
        font-size: 1em;
        margin-bottom: 1em;
        width: 100%;
        box-sizing: border-box;
    }

    /* DataTable Search Label */
    .dataTables_wrapper .dataTables_filter label {
        font-weight: 600;
        color: #333;
    }

    /* DataTable Pagination */
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.5em 1em;
        margin: 0 0.1em;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #007bff;
        color: #fff;
        text-align: center;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background-color: #0056b3;
        color: #fff;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background-color: #004085;
        color: #fff;
        border: 1px solid #004085;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
        background-color: #e9ecef;
        color: #6c757d;
        cursor: not-allowed;
    }

    /* Chart Container */
    .chart-container {
        height: 400px;
        width: 100%;
        margin-top: 2rem;
    }

    /* Dashboard Cards */
    .dashboard-card {
        background: #fff;
        border-radius: 8px;
        padding: 1.5rem;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .dashboard-card:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .dashboard-card h3 {
        color: #fff;
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }

    .dashboard-card p {
        font-size: 2rem;
        color: #fff;
    }

    /* Overall Layout */
    .container-fluid {
        padding: 2rem;
        background: #f8f9fa;
    }

    .flex-1 {
        padding: 2rem;
        background: #fff;
    }

    /* Table Styling */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
    }

    thead {
        background-color: #007bff;
        color: #fff;
    }

    th, td {
        padding: 1rem;
        text-align: center;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #e9ecef;
    }

    .status-tag {
        padding: 0.5rem 1rem;
        border-radius: 12px;
        font-size: 0.875rem;
        font-weight: 600;
        color: #fff;
        display: inline-block;
    }

    .status-completed {
        background-color: #28a745;
    }

    .status-submitted {
        background-color: #007bff;
    }

    .status-pending {
        background-color: #dc3545;
    }

/* Flex container for chart and table */
.flex-chart-table {
    display: flex;
    flex-direction: row; /* Ensure chart and table are side by side */
    align-items: flex-start; /* Align chart with the start of the table */
    gap: 2rem; /* Space between chart and table */
    margin-top: 2rem;
}

/* Chart Container */
.chart-wrapper {
    flex: 1;
    min-width: 400px; /* Ensure minimum width */
    max-width: 450px; /* Adjusted for a more balanced look */
    height: auto; /* Auto height to fit content */
    padding: 20px;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    position: relative;
}

/* Chart Title */
.chart-wrapper h3 {
    margin-bottom: 20px;
    text-align: center;
    color: #333;
    font-size: 1.5rem;
    font-weight: 600;
}

/* Chart Canvas Styling */
.chart-wrapper canvas {
    width: 100% !important;
    height: auto !important;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 10px; /* Add padding to give the chart some space from the border */
    box-sizing: border-box;
}
 

    .table-wrapper {
        flex: 2;
        background-color: #fff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>

@section('content')
<div class="container-fluid p-0 font-roboto">
    <div class="flex min-h-screen bg-[#f8f9fa]">
        <!-- Main Content -->
        <div class="flex-1 bg-white p-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-4xl text-[#212529] font-bold">Welcome, {{ Auth::user()->name }}</h1>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8 mt-8">
                <div id="totalTasksCard" class="dashboard-card bg-[#f35d32] cursor-pointer">
                    <h3>Total Tasks</h3>
                    <p>{{ $tasksCount }}</p>
                </div>
                <div id="pendingTasksCard" class="dashboard-card bg-[#e91e63] cursor-pointer">
                    <h3>Pending Tasks</h3>
                    <p>{{ $pendingTasksCount }}</p>
                </div>
                <div id="completedTasksCard" class="dashboard-card bg-[#67CB35] cursor-pointer">
                    <h3>Completed Tasks</h3>
                    <p>{{ $completedTasksCount }}</p>
                </div>
            </div>
            
            <!-- Table and Chart for all users -->
            @unless(Auth::user()->hasRole('superadmin'))
            <div class="flex-chart-table">
                <!-- Table Wrapper -->
                <div class="table-wrapper">
                    <h3 class="text-3xl font-semibold text-[#212529] mb-4">Tasks Overview</h3>
                    <table id="tasksTable" class="w-full text-[#2c3e50] border-collapse border border-gray-200 rounded-lg overflow-hidden">
                        <thead>
                            <tr>
                                <th class="border-b px-6 py-4 text-center font-medium">Serial No</th>
                                <th class="border-b px-6 py-4 text-center font-medium">Task Title</th>
                                <th class="border-b px-6 py-4 text-center font-medium">Status</th>
                                <th class="border-b px-6 py-4 text-center font-medium">Assigned User</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                @if ($task->assignedUser && $task->assignedUser->id === Auth::id())
                                    <tr class="hover:bg-[#e9ecef] transition-all text-center">
                                        <td class="border-b px-6 py-4">{{ $task->id }}</td>
                                        <td class="border-b px-6 py-4">{{ $task->title }}</td>
                                        <td class="px-4 py-3 border-b border-gray-300">
                                            @if($task->status_id == 4)
                                                <span class="status-tag status-completed">Completed</span>
                                            @elseif($task->status_id == 2)
                                                <span class="status-tag status-submitted">Submitted</span>
                                            @else
                                                <span class="status-tag status-pending">Pending</span>
                                            @endif
                                        </td>
                                        <td class="border-b px-6 py-4">
                                            {{ $task->assignedUser ? $task->assignedUser->name : 'Not assigned' }}
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Chart Wrapper -->
                <div class="chart-wrapper">
                    <h3 class="text-2xl font-bold text-[#212529] mb-6 text-center">Task Distribution by Status</h3>
                    <canvas id="tasksChart"></canvas>
                </div>
            </div>
            @endunless

            <!-- Additional content for superadmins -->
            @if (Auth::user()->hasRole('superadmin'))
            <div class="flex-chart-table">
                <!-- Table Wrapper -->
                <div class="table-wrapper">
                    <h3 class="text-3xl font-semibold text-[#212529] mb-4">Tasks Overview</h3>
                    <table id="tasksTable" class="w-full text-[#2c3e50] border-collapse border border-gray-200 rounded-lg overflow-hidden">
                        <thead>
                            <tr>
                                <th class="border-b px-6 py-4 text-center font-medium">Serial No</th>
                                <th class="border-b px-6 py-4 text-center font-medium">Task Title</th>
                                <th class="border-b px-6 py-4 text-center font-medium">Status</th>
                                <th class="border-b px-6 py-4 text-center font-medium">Assigned User</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr class="hover:bg-[#e9ecef] transition-all text-center">
                                    <td class="border-b px-6 py-4">{{ $task->id }}</td>
                                    <td class="border-b px-6 py-4">{{ $task->title }}</td>
                                    <td class="px-4 py-3 border-b border-gray-300">
                                        @if($task->status_id == 4)
                                            <span class="status-tag status-completed">Completed</span>
                                        @elseif($task->status_id == 2)
                                            <span class="status-tag status-submitted">Submitted</span>
                                        @else
                                            <span class="status-tag status-pending">Pending</span>
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
                <!-- Chart Wrapper -->
                <div class="chart-wrapper">
                    <h3 class="text-2xl font-bold text-[#212529] mb-6 text-center">Task Distribution by Status</h3>
                    <canvas id="tasksChart"></canvas>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>

<script>
    const ctx = document.getElementById('tasksChart').getContext('2d');
    const tasksChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Total Tasks', 'Pending Tasks', 'Completed Tasks'],
            datasets: [{
                label: '# of Tasks',
                data: [{{ $tasksCount }}, {{ $pendingTasksCount }}, {{ $completedTasksCount }}],
                backgroundColor: [
                    '#f35d32',
                    '#e91e63',
                    '#67CB35'
                ],
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw;
                        }
                    }
                }
            }
        }
    });
</script>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    const dataTable = $('#tasksTable').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "pageLength": 5,
        "dom": '<"top"f>rt<"bottom"p><"clear">',
        "language": {
            "search": "_INPUT_",
            "searchPlaceholder": "Search tasks..."
        },
        "columnDefs": [
            { "orderable": false, "targets": [1, 2] }
        ]
    });

    // Click event handlers for filtering tasks
    $('#totalTasksCard').click(function() {
        dataTable.search('').draw(); // Clear any existing filters
    });

    $('#pendingTasksCard').click(function() {
        dataTable.search('Pending').draw(); // Filter to show only pending tasks
    });

    $('#completedTasksCard').click(function() {
        dataTable.search('Completed').draw(); // Filter to show only completed tasks
    });
});
</script>
@endpush
