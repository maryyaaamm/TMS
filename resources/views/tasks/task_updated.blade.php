<!DOCTYPE html>
<html>
<head>
    <title>Task Updated</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; }
        h1 { color: #333; }
        .detail { margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Task Updated</h1>
        <div class="detail"><strong>Title:</strong> {{ $task->title }}</div>
        <div class="detail"><strong>Description:</strong> {{ $task->description }}</div>
        <div class="detail"><strong>Status:</strong> {{ $task->status_id }}</div>
        <div class="detail"><strong>Assigned To:</strong> {{ $task->assigned_to }}</div>
        <div class="detail"><strong>Created At:</strong> {{ $task->created_at }}</div>
        <div class="detail"><strong>Updated At:</strong> {{ $task->updated_at }}</div>
    </div>
</body>
</html>
