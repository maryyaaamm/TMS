@extends('layouts.dashboard')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white rounded-lg shadow-lg min-h-screen flex flex-col">
    <div class="mb-6">
        <h1 class="text-center text-blue-700 text-3xl font-semibold mb-6">
            <i class="fas fa-users mr-2"></i> Users
        </h1>
        <div class="overflow-x-auto">
            <table class="w-full bg-white border border-gray-300 rounded-lg shadow-sm">
                <thead class="bg-blue-200 text-blue-700 text-sm uppercase">
                    <tr>
                        <th class="px-4 py-3 border-b border-gray-300 font-medium text-left">Name</th>
                        <th class="px-4 py-3 border-b border-gray-300 font-medium text-left">Email</th>
                        {{-- <th class="px-4 py-3 border-b border-gray-300 font-medium text-left">Role</th> --}}
                        <th class="px-4 py-3 border-b border-gray-300 font-medium text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm">
                    @foreach($users as $user)
                        @if($user->name !== 'Admin User') <!-- Exclude users with the name "Admin" -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3 border-b border-gray-300">{{ $user->name }}</td>
                                <td class="px-4 py-3 border-b border-gray-300">{{ $user->email }}</td>
                                {{-- <td class="px-4 py-3 border-b border-gray-300">
                                    @foreach($user->roles as $role) 
                                        @if($role->name !== 'Superadmin')
                                            {{ $role->name }}@if(!$loop->last), @endif
                                        @endif
                                    @endforeach
                                </td> --}}
                                <td class="px-4 py-3 border-b border-gray-300 text-center">
                                    <a href="{{ route('tasks.edit', $user->id) }}"
                                       class="inline-block px-4 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 transition-colors">
                                       Edit
                                    </a>
                                    <td class="px-4 py-3 border-b border-gray-300 text-center">
                                        <a href="{{ route('users.show', $user->id) }}"
                                           class="inline-block px-4 py-2 bg-green-500 text-white font-semibold rounded-md hover:bg-green-600 transition-colors mt-2">
                                           View
                                        </a>
                                    </td>
                                    
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Optional Pagination -->
    {{-- <div class="mt-4 flex justify-end">
        {{ $users->links() }} <!-- If using pagination -->
    </div> --}}
</div>
@endsection
