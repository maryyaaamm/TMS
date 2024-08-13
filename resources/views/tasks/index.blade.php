@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tasks</h1>

        <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create Task</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Assigned To</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->status ? $task->status->name : 'No status' }}</td>
                        <td>{{ $task->assignedUser ? $task->assignedUser->name : 'Not assigned' }}</td>
                        <td>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <a href="{{ route('tasks.assign', $task->id) }}" class="btn btn-info">Assign</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
