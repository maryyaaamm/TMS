<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TaskStatus;

class TaskStatusesTableSeeder extends Seeder
{
    public function run()
    {
        $statuses = ['Pending', 'Submitted', 'In Progress', 'Completed'];

        foreach ($statuses as $status) {
            // Check if the status already exists to avoid duplicate entries
            if (!TaskStatus::where('name', $status)->exists()) {
                TaskStatus::create(['name' => $status]);
            }
        }
    }
}
