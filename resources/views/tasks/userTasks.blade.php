@extends('layouts.app')

@section('content')
<div class="container">
    <h1>My Tasks</h1>
    
    @if(Auth::user()->hasRole('superadmin'))
        <!-- Superadmin view: Display all tasks -->
        <h2>All Tasks</h2>
        @if ($tasks->isEmpty())
            <p>No tasks available.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Assigned To</th>
                        <th>Submit Document</th>
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
                                    <div class="form-group">
                                        <input type="file" name="document" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit Document</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @else
        <!-- Regular user view: Display only assigned tasks -->
        @if ($tasks->isEmpty())
            <p>No tasks assigned.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Submit Document</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->status->name ?? 'No status' }}</td>
                            <td>
                                <form action="{{ route('tasks.submitDocument', $task->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <input type="file" name="document" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit Document</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endif
</div>
@endsection
