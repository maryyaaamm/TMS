<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected $table = 'task_statuses'; // Correct table name

    // Relationships
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
