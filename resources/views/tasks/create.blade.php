@extends('layouts.app')

@section('content')
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; background-color: #111; border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
        <h1 style="text-align: center; color: #ff69b4; margin-bottom: 20px; font-family: 'Arial', sans-serif; font-size: 2rem; letter-spacing: 0.5px;">Create Task</h1>
        <form action="{{ route('tasks.store') }}" method="POST" style="background-color: #222; padding: 20px; border-radius: 8px;">
            @csrf
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="title" style="display: block; margin-bottom: 8px; font-weight: bold; color: #ff69b4; font-family: 'Arial', sans-serif;">Title</label>
                <input type="text" class="form-control" id="title" name="title" required
                    style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ff69b4; background-color: #333; color: #fff; font-size: 1rem; transition: border-color 0.3s ease;">
            </div>
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="description" style="display: block; margin-bottom: 8px; font-weight: bold; color: #ff69b4; font-family: 'Arial', sans-serif;">Description</label>
                <textarea class="form-control" id="description" name="description" required
                    style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ff69b4; background-color: #333; color: #fff; font-size: 1rem; transition: border-color 0.3s ease; height: 120px;"></textarea>
            </div>
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="status" style="display: block; margin-bottom: 8px; font-weight: bold; color: #ff69b4; font-family: 'Arial', sans-serif;">Status</label>
                <select class="form-control" id="status" name="status_id"
                    style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ff69b4; background-color: #333; color: #fff; font-size: 1rem; transition: border-color 0.3s ease;">
                    @foreach ($statuses as $status)
                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success"
                style="width: 100%; padding: 12px; background-color: #ff69b4; border: none; border-radius: 6px; color: white; font-weight: bold; font-size: 1.1rem; transition: background-color 0.3s ease, transform 0.3s ease; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);">
                Create Task
            </button>
        </form>
    </div>
@endsection
