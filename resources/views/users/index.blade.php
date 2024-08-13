@extends('layouts.app')

@section('content')
<div class="container" style="background-color: #000; color: #fff; padding: 20px; border-radius: 10px; min-height: 80vh; display: flex; flex-direction: column; justify-content: space-between;">
    <div>
        <h1 style="text-align: center; font-size: 2.5rem; margin-bottom: 20px; color: #ff69b4; font-family: 'Arial', sans-serif;">Users</h1>
        <table class="table" style="width: 100%; border-collapse: separate; border-spacing: 0; background-color: #1c1c1c; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
            <thead>
                <tr style="background-color: #333; color: #ff69b4; text-transform: uppercase; letter-spacing: 1px; font-size: 1rem;">
                    <th style="padding: 10px; border-bottom: 2px solid #ff69b4; border-right: 1px solid #ff69b4;">Name</th>
                    <th style="padding: 10px; border-bottom: 2px solid #ff69b4; border-right: 1px solid #ff69b4;">Email</th>
                    <th style="padding: 10px; border-bottom: 2px solid #ff69b4; border-right: 1px solid #ff69b4;">Role</th>
                    <th style="padding: 10px; border-bottom: 2px solid #ff69b4;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr style="transition: background-color 0.3s ease; font-size: 0.9rem; text-align: center;">
                        <td style="padding: 10px; border-bottom: 1px solid #ff69b4; border-right: 1px solid #ff69b4;">{{ $user->name }}</td>
                        <td style="padding: 10px; border-bottom: 1px solid #ff69b4; border-right: 1px solid #ff69b4;">{{ $user->email }}</td>
                        <td style="padding: 10px; border-bottom: 1px solid #ff69b4; border-right: 1px solid #ff69b4;">{{ $user->roles->pluck('name')->implode(', ') }}</td>
                        <td style="padding: 10px; border-bottom: 1px solid #ff69b4;">
                            <a href="{{ route('tasks.assign', $user->id) }}" class="btn" style="color: #fff; background-color: #ff69b4; padding: 8px 12px; border-radius: 5px; text-decoration: none; transition: background-color 0.3s ease;">
                                Assign Tasks
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<footer style="background-color: #333; color: #ff69b4; text-align: center; padding: 10px; font-size: 0.8rem; font-family: 'Arial', sans-serif;">
    &copy; 2024 Your Website. All Rights Reserved. | Contact: email@example.com
</footer>
@endsection
