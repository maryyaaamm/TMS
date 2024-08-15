<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa; /* Light background for the entire page */
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff; /* White background for the container */
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 5%; /* Centering the box vertically */
        }
        h1 {
            text-align: center;
            color: #212529; /* Dark gray for the title */
            margin-bottom: 20px;
            font-size: 2rem;
            letter-spacing: 0.5px;
        }
        form {
            background-color: #ffffff; /* White background for the form */
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ced4da; /* Border color */
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #212529; /* Dark gray for the label */
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ced4da; /* Light gray border */
            background-color: #ffffff; /* White background for input fields */
            color: #212529; /* Dark gray text color */
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }
        .form-control:focus {
            border-color: #007bff; /* Accent color for focus */
            outline: none;
        }
        .btn {
            width: 100%;
            padding: 12px;
            background-color: #007bff; /* Primary accent color for button */
            border: none;
            border-radius: 6px;
            color: white;
            font-weight: bold;
            font-size: 1.1rem;
            transition: background-color 0.3s ease, transform 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn:hover {
            background-color: #0056b3; /* Darker shade for hover effect */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create Task</h1>
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status_id">
                    @foreach ($statuses as $status)
                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn">
                Create Task
            </button>
        </form>
    </div>
</body>
</html>
