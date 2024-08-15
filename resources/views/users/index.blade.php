@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-gray-100 rounded-lg shadow-lg min-h-screen flex flex-col justify-between">
    <div class="mb-12">
        <h1 class="text-center text-pink-500 text-4xl font-bold mb-8 font-sans">
            <i class="fas fa-users mr-2"></i> Users
        </h1>
        <div class="overflow-x-auto">
            <table class="w-full bg-white border border-gray-300 rounded-lg shadow-sm mt-4 mb-8">
                <thead class="bg-pink-100 text-pink-500 text-sm uppercase">
                    <tr>
                        <th class="px-4 py-3 border-b border-pink-500 font-semibold">Name</th>
                        <th class="px-4 py-3 border-b border-pink-500 font-semibold">Email</th>
                        {{-- <th class="px-4 py-3 border-b border-pink-500 font-semibold">Role</th> --}}
                        <th class="px-4 py-3 border-b border-pink-500 font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm">
                    @foreach($users as $user)
                        <tr class="hover:bg-pink-50 transition-colors">
                            <td class="px-4 py-3 border-b border-gray-300">{{ $user->name }}</td>
                            <td class="px-4 py-3 border-b border-gray-300">{{ $user->email }}</td>
                            {{-- <td class="px-4 py-3 border-b border-gray-300">{{ $user->roles->pluck('name')->implode(', ') }}</td> --}}
                            <td class="px-4 py-3 border-b border-gray-300 text-center">
                                <a href="{{ route('tasks.edit', $user->id) }}"
                                   class="inline-block px-4 py-2 bg-pink-500 text-white font-bold rounded-md hover:bg-pink-600 transition-colors">
                                   Assign Task
                                </a>                            
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
