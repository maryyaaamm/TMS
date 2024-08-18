<?php

namespace App\Exports;

use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TasksReportExport implements FromCollection, WithHeadings, WithMapping
{
    protected $tasks;

    public function __construct($tasks)
    {
        $this->tasks = $tasks;
    }

    public function collection()
    {
        return $this->tasks;
    }

    public function headings(): array
    {
        return [
            'Task Title',
            'Assigned To',
            'Status',
            'Document',
        ];
    }

    public function map($task): array
    {
        return [
            $task->title,
            $task->assignedUser->name ?? 'Unassigned',
            $task->status->name ?? 'No status',
            $task->document_path ? Storage::url($task->document_path) : 'Not Available',
        ];
    }
}
