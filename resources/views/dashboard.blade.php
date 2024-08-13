@extends('layouts.app')
<style>
    /* Global Styles */
    body {
        font-family: 'Figtree', sans-serif;
        background-color: #1f1f1f;
        color: #ff69b4;
    }
    
    /* Layout and Positioning */
    .dashboard {
        display: flex;
        height: 100vh;
    }
    .sidebar {
        background-color: #121212;
        width: 260px;
        padding: 1rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
    }
    .logo-container {
        margin-bottom: 2rem;
    }
    .logo {
        width: 100px;
        height: auto;
    }
    .nav-links {
        list-style-type: none;
        width: 100%;
        padding: 0;
    }
    .nav-links li {
        margin: 1rem 0;
    }
    .nav-links a {
        color: #b3b3b3;
        text-decoration: none;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        padding: 0.5rem 1rem;
        border-radius: 0.25rem;
        transition: background-color 0.3s;
    }
    .nav-links a i {
        margin-right: 0.5rem;
    }
    .nav-links a:hover, .nav-links a.active {
        background-color: #272727;
        color: #ff69b4;
    }
    
    /* Main Content */
    .main-content {
        flex: 1;
        padding: 2rem;
        overflow-y: auto;
    }
    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }
    .navbar h1 {
        font-size: 2rem;
        color: #ff69b4;
    }
    .logout-button {
        background-color: #ff69b4;
        color: #ffffff;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        font-weight: 600;
        transition: background-color 0.3s;
    }
    .logout-button:hover {
        background-color: #ff1493;
    }

    /* Cards */
    .overview {
        display: flex;
        gap: 2rem;
    }
    .card {
        background-color: #272727;
        border: 1px solid #3a3a3a;
        border-radius: 0.5rem;
        padding: 1.5rem;
        text-align: center;
        flex: 1;
        color: #ffffff;
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
    }
    .card h3 {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
        color: #ff69b4;
    }
    .card p {
        font-size: 2.5rem;
        margin: 0;
    }
</style>
@section('content')
<div class="dashboard">
    <div class="sidebar">
        <div class="logo-container">
            <img src="{{ asset('storage/image.png') }}"alt="Logo" class="logo">
        </div>
        <ul class="nav-links">
            <li><a href="{{ route('tasks.userTasks') }}"><i class="fas fa-home"></i> Home</a></li>
            @if(Auth::user()->hasRole('superadmin'))
                <li><a href="{{ route('tasks.create') }}"><i class="fas fa-plus-circle"></i> Create Task</a></li>
                <li><a href="{{ route('tasks.index') }}"><i class="fas fa-tasks"></i> Tasks</a></li>
                <li><a href="{{ route('users.index') }}"><i class="fas fa-users"></i> Users</a></li>
            @endif
        </ul>
    </div>
    <div class="main-content">
        <div class="navbar">
            <h1>Welcome, {{ Auth::user()->name }}</h1>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-button"><i class="fas fa-sign-out-alt"></i> Logout</button>
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


@endsection
