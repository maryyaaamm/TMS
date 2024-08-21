@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Task Reports</h2>
    
    <!-- Button to download the report -->
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('tasks.report') }}" class="btn btn-primary">
            <i class="fas fa-file-excel"></i> Download Report
        </a>
    </div>
    <li>
        <a href="{{ route('tasks.reports') }}" class="flex items-center text-white hover:text-primary hover:bg-gray-700 px-4 py-3 rounded-md text-lg transition duration-300">
            <i class="fas fa-file-alt mr-3"></i> Task Reports
        </a>
    </li>
    
    <!-- Optionally, you can display the users and tasks here if needed -->
    <!-- For simplicity, this example assumes you only need the button to download the report -->
</div>
@endsection
