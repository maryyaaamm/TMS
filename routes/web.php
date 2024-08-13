<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Routes that require authentication
Route::middleware(['auth'])->group(function () {
    // Dashboard Route
    Route::get('/dashboard', [TaskController::class, 'dashboard'])->name('dashboard');

    // Task Routes
    Route::prefix('tasks')->name('tasks.')->group(function () {
        Route::get('/', [TaskController::class, 'index'])->name('index');
        Route::get('/create', [TaskController::class, 'create'])->name('create');
        Route::post('/', [TaskController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [TaskController::class, 'edit'])->name('edit');
        Route::put('/{id}', [TaskController::class, 'update'])->name('update');
        Route::delete('/{id}', [TaskController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/submit-document', [TaskController::class, 'submitDocument'])->name('submitDocument');
        Route::get('/{id}/download', [TaskController::class, 'downloadDocument'])->name('downloadDocument');
        Route::get('/assign', [TaskController::class, 'assign'])->name('assign');
        Route::post('/assignTask', [TaskController::class, 'assignTask'])->name('assignTask');
        Route::get('/userTasks', [TaskController::class, 'userTasks'])->name('userTasks');
    });
    

    // User Routes
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/{id}/editPermissions', [UserController::class, 'editPermissions'])->name('editPermissions');
        Route::put('/{id}/updatePermissions', [UserController::class, 'updatePermissions'])->name('updatePermissions');
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
