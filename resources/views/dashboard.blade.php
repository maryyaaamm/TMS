@extends('layouts.app')

@section('content')
<div class="dashboard">
    <div class="sidebar">
        <h2>Dashboard</h2>
        <ul class="nav-links">
            
            <li><a href="{{ route('tasks.userTasks') }}">My Tasks</a></li>
            @if(Auth::user()->hasRole('superadmin'))
                <li><a href="{{ route('tasks.create') }}">Create Task</a></li>
                <li><a href="{{ route('tasks.index') }}">Tasks</a></li>
            <li><a href="{{ route('users.index') }}">Users</a></li>
                {{-- @foreach($tasks as $task)
        <li><a href="{{ route('tasks.assign', ['id' => $task->id]) }}">Assign Task: {{ $task->name }}</a></li>
    @endforeach --}}
            @endif
        </ul>
    </div>
    <div class="main-content">
        <div class="navbar">
            <h1>Welcome, {{ Auth::user()->name }}</h1>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-button">Logout</button>
            </form>
        </div>
        <div class="overview">
            <div class="card">
                <h3>Total Tasks</h3>
                <p>{{ $tasksCount }}</p>
            </div>
            <div class="card">
                <h3>Completed Tasks</h3>
                <p>{{ $completedTasksCount }}</p>
            </div>
            <div class="card">
                <h3>Pending Tasks</h3>
                <p>{{ $pendingTasksCount }}</p>
            </div>
        </div>
    </div>
</div>

<style>
    /* Layout and Positioning */
    .dashboard {
        display: flex;
    }
    .sidebar {
        background-color: #000000;
        color: #ff69b4;
        width: 250px;
        min-height: 100vh;
        padding: 1rem;
    }
    .sidebar h2 {
        text-align: center;
        margin-bottom: 2rem;
    }
    .nav-links {
        list-style-type: none;
        padding: 0;
    }
    .nav-links li {
        margin: 1rem 0;
    }
    .nav-links a {
        color: #ff69b4;
        text-decoration: none;
        font-weight: 600;
    }
    .nav-links a:hover {
        color: #ff1493;
    }
    .main-content {
        flex: 1;
        padding: 2rem;
        background-color: #1f1f1f;
        color: #ff69b4;
    }

    /* Typography */
    .main-content h1 {
        font-size: 2.5rem;
        margin-bottom: 1.5rem;
    }
    .sidebar h2, .card h3 {
        font-family: 'Figtree', sans-serif;
        font-size: 1.8rem;
        color: #ff69b4;
    }

    /* Navbar */
    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    /* Logout Button */
    .logout-button {
        background-color: #ff69b4;
        color: #ffffff;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 600;
        transition: background-color 0.3s ease;
    }
    .logout-button:hover {
        background-color: #ff1493;
    }

    /* Cards */
    .overview {
        display: flex;
        gap: 1.5rem;
    }
    .card {
        background-color: #ff69b4;
        border: 1px solid #ff1493;
        border-radius: 0.25rem;
        padding: 1rem;
        text-align: center;
        flex: 1;
        color: #1f1f1f;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .card h3 {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
        color: #ffffff;
    }
    .card p {
        font-size: 2rem;
        margin: 0;
    }
</style>
@endsection
