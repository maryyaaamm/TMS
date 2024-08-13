<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('status', 'assignedUser')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
{
    $statuses = TaskStatus::all(); // Assuming you have a TaskStatus model
    return view('tasks.create', ['statuses' => $statuses]);
}


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status_id' => 'required|exists:task_statuses,id',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        Task::create($request->all());

        return redirect()->route('tasks.index');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $statuses = TaskStatus::all();
        return view('tasks.edit', compact('task', 'statuses'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status_id' => 'required|exists:task_statuses,id',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'status_id' => $request->status_id,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    public function assignId($id)
{
    $task = Task::findOrFail($id);
    $users = User::all();
    $statuses = TaskStatus::all(); // Fetch all task statuses
    return view('tasks.assign', compact('task', 'users', 'statuses'));
}


    // TaskController.php

public function assign()
{
    $tasks = Task::all(); // Fetch all tasks
    $users = User::all(); // Fetch all users
    $statuses = TaskStatus::all(); // Fetch all statuses

    return view('tasks.assign', compact('tasks', 'users', 'statuses'));
}


    public function assignTask(Request $request)
{
    $request->validate([
        'task_id' => 'required|exists:tasks,id',
        'user_id' => 'required|exists:users,id',
    ]);

    $task = Task::findOrFail($request->input('task_id'));
    $task->assigned_to = $request->input('user_id'); // Update to use assigned_to
    $task->save();

    return redirect()->route('tasks.index')->with('success', 'Task assigned successfully.');
}


public function userTasks()
{
    $tasks = Task::where('assigned_to', Auth::id())->with('status')->get();
    return view('tasks.userTasks', compact('tasks'));
}


    public function dashboard()
    {
        $tasks = Task::all();
        $tasksCount = $tasks->count();
        $completedTasksCount = $tasks->where('status_id', 3)->count();
        $pendingTasksCount = $tasks->where('status_id', 1)->count();

        return view('dashboard', compact('tasks', 'tasksCount', 'completedTasksCount', 'pendingTasksCount'));
    }

    public function submitDocument(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'document' => 'required|file|mimes:pdf,doc,docx,txt|max:2048', // Adjust file types and size as needed
        ]);

        // Find the task by ID
        $task = Task::findOrFail($id);

        // Handle the file upload
        if ($request->hasFile('document')) {
            $filePath = $request->file('document')->store('documents');

            // Save the document path to the task (assuming you have a document_path column in your tasks table)
            $task->document_path = $filePath;
            $task->save();
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Document submitted successfully.');
    }
}
