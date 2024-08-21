<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::middleware(['auth'])->group(function () {
    // Task Routes
    Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::get('tasks/assign', [TaskController::class, 'assign'])->name('tasks.assign');
    Route::post('tasks/assignTask', [TaskController::class, 'assignTask'])->name('tasks.assignTask');
    Route::get('/tasks/userTasks', [TaskController::class, 'userTasks'])->name('tasks.userTasks');
    Route::get('/dashboard', [TaskController::class, 'dashboard'])->name('dashboard');
    Route::post('/tasks/{id}/submit-document', [TaskController::class, 'submitDocument'])->name('tasks.submitDocument');

    // User Routes
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/{id}/editPermissions', [UserController::class, 'editPermissions'])->name('users.editPermissions');
    Route::put('users/{id}/updatePermissions', [UserController::class, 'updatePermissions'])->name('users.updatePermissions');
});

// Home Route
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard Route (requires authentication)
Route::get('/dashboard', [TaskController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
