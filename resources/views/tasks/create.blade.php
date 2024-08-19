@extends('layouts.dashboard')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task</title>

    <!-- Include Tailwind CSS and JS with Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Initialize Self-Hosted TinyMCE -->
    <script src="/js/tinymce/tinymce.min.js"></script>

    <script>
        tinymce.init({
            selector: '#description',
            plugins: 'advlist autolink lists link image charmap preview anchor textcolor',
            toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor | removeformat',
            menubar: false,
            branding: false,
            height: 300,
            skin: 'oxide-dark',
            content_css: 'dark',
            content_style: "body { background-color: white; color: black; }",
            setup: function(editor) {
                editor.on('change', function() {
                    tinymce.triggerSave();
                });
            }
        });
    </script>
</head>

<body class="bg-gray-100 font-sans">
    <div class="flex min-h-screen">
        <!-- Sidebar omitted for brevity -->

        @section('content')

        <!-- Main Content -->
        <div class="flex-1 bg-gray-50 p-10 overflow-auto flex flex-col items-center">
            <!-- Page Title -->
            <div class="flex justify-center items-center w-full mb-6">
                <h1 class="text-3xl font-bold text-gray-900" style="padding: 20px 0;">
                    <i class="fas fa-plus-circle mr-2 text-blue-500"></i> Create Task
                </h1>
            </div>

            <!-- Form Container -->
            <div class="w-full max-w-lg bg-white p-8 rounded-lg shadow-lg">
                <!-- Create Task Form -->
                <form action="{{ route('tasks.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Task Title -->
                    <div class="flex items-center">
                        <i class="fas fa-pencil-alt text-gray-500 mr-3"></i>
                        <label for="title" class="block text-lg font-medium text-black mb-2">Title</label>
                    </div>
                    <input type="text" id="title" name="title" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-black">

                    <!-- Task Description (With TinyMCE Editor) -->
                    <div class="flex items-center mt-4">
                        <i class="fas fa-align-left text-gray-500 mr-3"></i>
                        <label for="description" class="block text-lg font-medium text-black mb-2">Description</label>
                    </div>
                    <textarea id="description" name="description" required rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm text-black"></textarea>

                    <!-- Task Status -->
                    <div class="flex items-center mt-4">
                        <i class="fas fa-list-alt text-gray-500 mr-3"></i>
                        <label for="status" class="block text-lg font-medium text-black mb-2">Status</label>
                    </div>
                    <select id="status" name="status_id" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-black">
                        @foreach ($statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                        @endforeach
                    </select>

                    <!-- Assign User -->
                    <div class="flex items-center mt-4">
                        <i class="fas fa-user text-gray-500 mr-3"></i>
                        <label for="assigned_user" class="block text-lg font-medium text-black mb-2">Assign User</label>
                    </div>
                    <select id="assigned_user" name="assigned_to" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-black">
                        <option value="">Select User</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit"
                            class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 transition ease-in-out duration-200">
                            <i class="fas fa-check-circle mr-2"></i> Create Task
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
@endsection
