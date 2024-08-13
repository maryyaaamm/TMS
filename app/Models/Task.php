<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status_id',
        'created_by',
        'assigned_to',
        'document_path', // Add this field

    ];

    // Relationships
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function status()
    {
        return $this->belongsTo(TaskStatus::class, 'status_id');
    }

    public function taskAssignments()
    {
        return $this->hasMany(TaskAssignment::class);
    }

    // Add this method
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
