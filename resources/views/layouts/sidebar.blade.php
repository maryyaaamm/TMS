<div class="text-white w-64 p-4 flex flex-col items-center min-h-screen bg-gray-800 shadow-lg">
    <!-- Logo Section -->
    <div class="mb-8">
        <img src="https://th.bing.com/th/id/OIP.MAleQeDj2W5A7kkxCfLMjgHaFj?w=233&h=180&c=7&r=0&o=5&pid=1.7"
            alt="Logo" class="w-24 h-24 rounded-full mb-4">
        <h2 class="text-lg font-bold">Task Manager</h2>
    </div>

    <!-- Sidebar Menu -->
    <ul class="space-y-6 w-full">
        @unless (Auth::user()->hasRole('superadmin'))
        <li>
            <a href="{{ route('tasks.userTasks') }}"
                class="flex items-center text-white hover:text-blue-500 hover:bg-gray-700 px-4 py-3 rounded-md text-lg transition ease-in-out duration-300 transform hover:scale-105">
                <i class="fas fa-home mr-3"></i> Home
            </a>
        </li>
        @endunless

        @if (Auth::user()->hasRole('superadmin'))
        <li>
            <a href="{{ route('tasks.create') }}"
                class="flex items-center text-white hover:text-blue-500 hover:bg-gray-700 px-4 py-3 rounded-md text-lg transition ease-in-out duration-300 transform hover:scale-105">
                <i class="fas fa-plus-circle mr-3"></i> Create Task
            </a>
        </li>
        <li>
            <a href="{{ route('tasks.index') }}"
                class="flex items-center text-white hover:text-blue-500 hover:bg-gray-700 px-4 py-3 rounded-md text-lg transition ease-in-out duration-300 transform hover:scale-105">
                <i class="fas fa-tasks mr-3"></i> Tasks
            </a>
        </li>
        @endif
    </ul>

    <!-- Logout Section -->
    <div class="mt-auto">
        <form action="{{ route('logout') }}" method="POST" class="w-full">
            @csrf
            <button type="submit"
                class="w-full flex items-center justify-center text-white bg-blue-600 hover:bg-blue-700 px-4 py-3 rounded-md text-lg transition ease-in-out duration-300 transform hover:scale-105">
                <i class="fas fa-sign-out-alt mr-3"></i> Logout
            </button>
        </form>
    </div>
</div>
