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
        $users = User::with('roles')->get();
        return view('users.index', compact('users'));
    }

    public function editPermissions($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('users.editPermissions', compact('user', 'roles'));
    }

    public function userTasks()
    {
        $tasks = Task::where('assigned_user_id', Auth::id())->get();
        return view('tasks.userTasks', compact('tasks'));
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
