@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Permissions for {{ $user->name }}</h1>
    <form action="{{ route('users.updatePermissions', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Roles</label>
            @foreach($roles as $role)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}"
                        {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                    <label class="form-check-label">{{ $role->name }}</label>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-success">Update Permissions</button>
    </form>
</div>
@endsection
