<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskAssignment;
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

    // Set the 'created_by' field
    Task::create([
        'title' => $request->title,
        'description' => $request->description,
        'status_id' => $request->status_id,
        'assigned_to' => $request->assigned_to,
        'created_by' => auth()->id(), // Here, set the currently authenticated user's ID
    ]);

    return redirect()->route('tasks.index');
}


public function edit($id)
{
    $task = Task::findOrFail($id);
    $statuses = TaskStatus::all(); // Assuming you have a Status model
    $users = User::all(); // Fetch all users

    return view('tasks.edit', compact('task', 'statuses', 'users'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'status_id' => 'required|exists:Task_statuses,id',
        'assigned_to' => 'nullable|exists:users,id',
    ]);

    $task = Task::findOrFail($id);
    $task->update([
        'title' => $request->title,
        'description' => $request->description,
        'status_id' => $request->status_id,
        'assigned_to' => $request->assigned_to,
    ]);

    return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
}


    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    public function assignId($taskId)
{
    $task = Task::findOrFail($taskId);
    $users = User::all();
    $statuses = TaskStatus::all(); // Fetch all task statuses
    return view('tasks.assign', compact('task', 'users', 'statuses'));
}

    


    // TaskController.php

    public function assign(Request $request) {
        {
    $tasks = Task::all(); // Fetch all tasks
    $users = User::all(); // Fetch all users
    $statuses = TaskStatus::all(); // Fetch all statuses

    return view('tasks.assign', compact('tasks', 'users', 'statuses'));
}}


   // app/Http/Controllers/TaskController.php
   public function assignTask(Request $request)
   {
       $validated = $request->validate([
           'task_id' => 'required|exists:tasks,id',
           'user_id' => 'required|exists:users,id',
'status_id' => 'required|exists:task_statuses,id',
       ]);
   
       // Assuming you have a TaskUser model to assign tasks
       TaskAssignment::create([
           'task_id' => $validated['task_id'],
           'user_id' => $validated['user_id'],
           'status_id' => $validated['status_id'],
       ]);
   
       return redirect()->back()->with('success', 'Task assigned successfully.');
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
    $request->validate([
        'document' => 'required|mimes:pdf,doc,docx|max:2048',
    ]);

    $task = Task::findOrFail($id);

    if ($request->hasFile('document')) {
        $file = $request->file('document');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('documents', $filename, 'public');
        
        // Log path to check
        // \Log::info('Document path: ' . $path);
        
        $task->document_path = $filename;
        $task->save();
    }

    return redirect()->back()->with('success', 'Document uploaded successfully!');
}

public function downloadDocument($id)
{
    $task = Task::findOrFail($id);

    if ($task->document_path) {
        $filePath = storage_path('app/public/documents/' . $task->document_path);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return redirect()->back()->with('error', 'Document not found');
        }
    } else {
        return redirect()->back()->with('error', 'No document uploaded');
    }
}

}


