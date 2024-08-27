<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Mail\TaskUpdated;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Mail\Mailable;
use App\Models\Task;

Route::post('/tasks/track-time/{task}', [TaskController::class, 'trackTime'])->name('tasks.trackTime');

Route::get('/test-email', function () {
    $task = Task::find(1); // Adjust as needed

    if (!$task) {
        return 'Task not found!';
    }

    // Include additional task details
    $details = [
        'title' => $task->title,
        'description' => $task->description,
        'status' => $task->status->name, // Assuming you have a relationship to get status name
        'assignedTo' => $task->assignedTo ? $task->assignedTo->name : 'None', // Assuming you have a relationship to get assigned user name
        'created_at' => $task->created_at->format('Y-m-d H:i:s'),
        'updated_at' => $task->updated_at->format('Y-m-d H:i:s'),
    ];

    Mail::to('maryammnaveedd6@gmail.com')->send(new TaskUpdated($details));
    return 'Test email sent with task details!';
});


// Routes that require authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [TaskController::class, 'dashboard'])->name('dashboard');

    Route::prefix('tasks')->name('tasks.')->group(function () {
        Route::get('/', [TaskController::class, 'index'])->name('index');
        Route::get('/create', [TaskController::class, 'create'])->name('create');
        Route::post('/', [TaskController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [TaskController::class, 'edit'])->name('edit');
        Route::get('/{id}/edit', [TaskController::class, 'assign'])->name('edit');
        Route::put('/{id}', [TaskController::class, 'update'])->name('update'); // Keep this as the main update route
        Route::delete('/{id}', [TaskController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/submit-document', [TaskController::class, 'submitDocument'])->name('submitDocument');
        Route::get('/{id}/download', [TaskController::class, 'downloadDocument'])->name('downloadDocument');
        // Route::get('/assign/{id}', [TaskController::class, 'assign'])->name('assign'); // Consider renaming to tasks.assign for consistency
        Route::post('/assignTask', [TaskController::class, 'assignTask'])->name('assignTask');
        Route::get('/userTasks', [TaskController::class, 'userTasks'])->name('userTasks');
        Route::get('/tasks/report', [TaskController::class, 'generateReport'])->name('reports');
        Route::patch('/tasks/{task}/update-status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');


    });

    // User Routes
  // web.php
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/{id}/editPermissions', [UserController::class, 'editPermissions'])->name('editPermissions');
    Route::put('/{id}/updatePermissions', [UserController::class, 'updatePermissions'])->name('updatePermissions');
    Route::get('/{id}/view', [UserController::class, 'show'])->name('show'); // Update route name to 'show'
});


    // Profile Routes
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });
});

// Home Route (accessible without authentication)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Auth Routes (require authentication)
require __DIR__.'/auth.php';
