<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];
//     public function tasks()
//     {
//         return $this->hasMany(Task::class, 'users_id');
//     }
    
//     public function isOnline()
// {
//     // Example check using cache
//     return Cache::has('user-is-online-' . $this->id);
// }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationships
    public function tasksCreated()
    {
        return $this->hasMany(Task::class, 'created_by');
    }
    

    public function tasksAssigned()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    public function taskAssignments()
    {
        return $this->hasMany(TaskAssignment::class);
    }
}
