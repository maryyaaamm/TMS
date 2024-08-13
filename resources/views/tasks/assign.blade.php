@extends('layouts.app')

@section('content')
    <div class="container" style="background-color: #1c1c1c; color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
        <h1 style="text-align: center; font-size: 2rem; margin-bottom: 20px; color: #ff69b4;">Assign Tasks</h1>
        <form action="{{ route('tasks.assignTask') }}" method="POST" style="max-width: 600px; margin: auto;">
            @csrf
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="task_id" style="display: block; font-size: 1.1rem; margin-bottom: 5px;">Task</label>
                <select name="task_id" id="task_id" class="form-control" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ff69b4; background-color: #333; color: #fff; font-size: 1rem;">
                    @foreach($tasks as $task)
                        <option value="{{ $task->id }}">{{ $task->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="user_id" style="display: block; font-size: 1.1rem; margin-bottom: 5px;">User</label>
                <select name="user_id" id="user_id" class="form-control" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ff69b4; background-color: #333; color: #fff; font-size: 1rem;">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="status_id" style="display: block; font-size: 1.1rem; margin-bottom: 5px;">Status</label>
                <select name="status_id" id="status_id" class="form-control" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ff69b4; background-color: #333; color: #fff; font-size: 1rem;">
                    @foreach($statuses as $status)
                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn" style="display: block; width: 100%; padding: 10px; background-color: #ff69b4; color: #fff; border: none; border-radius: 5px; font-size: 1.1rem; cursor: pointer; transition: background-color 0.3s ease;">
                Assign Task
            </button>
        </form>
    </div>
@endsection
