<?php

namespace App\Http\Controllers;

use App\Mail\TaskUpdated;
use App\Models\Task;
use App\Models\TaskAssignment;
use App\Models\User;
use App\Models\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Mail\Mailable;
class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::query();
    
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%");
        }
    
        $tasks = $query->paginate(10);
    
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
    // Find the task by ID
    $task = Task::findOrFail($id);

    // Validate and update the task
    $task->update($request->only('title', 'description', 'status_id', 'assigned_to'));

    // Send the email
    Mail::to('maryammnaveedd6@gmail.com')->send(new TaskUpdated($task));

    // Redirect or return a response
    return redirect()->route('tasks.index')->with('success', 'Task updated and email sent!');
}


    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    public function assign($id)
    {  $task = Task::findOrFail($id);
        $statuses = TaskStatus::all(); // Assuming you have a Status model
        $users = User::all(); // Fetch all users
    
        return view('tasks.edit', compact('task', 'statuses', 'users'));
    }
    
    
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
    $user = Auth::user();

    if (!$user->hasRole('superadmin')) {
        $tasksCount = Task::where('assigned_to', $user->id)->count();
        $completedTasksCount = Task::where('assigned_to', $user->id)->where('status_id', 4)->count();
        $pendingTasksCount = Task::where('assigned_to', $user->id)->where('status_id', 1)->count();
        $submittedTasks = Task::where('assigned_to', $user->id)->where('status_id', 2)->get();
        $inProgressTasks = Task::where('assigned_to', $user->id)->where('status_id', 3)->get();
        $activeUsers = [];
    } else {
        $tasksCount = Task::count();
        $completedTasksCount = Task::where('status_id', 4)->count();
        $pendingTasksCount = Task::where('status_id', 1)->count();
        $submittedTasks = Task::where('status_id', 2)->get();
        $inProgressTasks = Task::where('status_id', 3)->get();
        $activeUsers = User::with('roles')->paginate(10); // Paginate active users
    }

    $tasks = Task::with('status', 'assignedUser')->paginate(10); // Paginate tasks

    return view('dashboard', compact(
        'tasks',
        'tasksCount',
        'completedTasksCount',
        'pendingTasksCount',
        'submittedTasks',
        'inProgressTasks',
        'activeUsers'
    ));
}


public function submitDocument(Request $request, $id)
{
    $task = Task::findOrFail($id);

    // Validate the request
    $request->validate([
        'document' => 'required|file|mimes:pdf,doc,docx|max:2048', // Adjust validation as needed
    ]);

    // Store the document
    if ($request->hasFile('document')) {
        $file = $request->file('document');
        $filePath = $file->store('documents', 'public'); // Store the file in the 'public/documents' directory
        $task->document_path = $filePath;
    }

    // Update task status based on the user's role
    if (Auth::user()->hasRole('superadmin')) {
        // Admin: Task status remains as 'in progress'
        $task->status_id = 3; // Assuming '3' is the status ID for 'in progress'
    } else {
        // Regular user: Set status to 'submitted'
        $task->status_id = 2; // Assuming '2' is the status ID for 'submitted'
    }

    $task->save();

    return redirect()->back()->with('success', 'Document submitted successfully.');
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
