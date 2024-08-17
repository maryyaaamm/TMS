<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Fetch all users with their names and emails
        $roles = Role::where('name', '!=', 'superadmin')->get(); // Exclude the Superadmin role
        return view('users.index', compact('users', 'roles'));
    }
    
    
    
    public function show($id)
    {
        
        $user = User::with('tasksAssigned', 'roles')->findOrFail($id);
        return view('users.show', compact('user'));
    }
    

    public function editPermissions($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('users.editPermissions', compact('user', 'roles'));
    }

    public function userTasks()
    {
        $users = User::with('roles')->get(); // Fetch users
        $tasks = Task::where('assigned_to', Auth::id())->get(); // Fetch tasks assigned to the logged-in user
        return view('tasks.userTasks', compact('tasks', 'users')); // Pass both tasks and users to the view
    }
    

    public function updatePermissions(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'roles' => 'array',
            'roles.*' => 'exists:roles,id',
        ]);

        $user->syncRoles($request->roles);

        return redirect()->route('users.index')->with('success', 'Permissions updated successfully.');
    }
}
