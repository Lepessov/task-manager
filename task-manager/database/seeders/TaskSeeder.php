<?php

namespace Database\Seeders;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::create([
            'title' => 'Task 1',
            'description' => 'Description for task 1',
            'status' => 'TODO',
            'importance' => 3,
            'deadline' => Carbon::now()->addDays(5), // Deadline in 5 days
        ]);

        Task::create([
            'title' => 'Task 2',
            'description' => 'Description for task 2',
            'status' => 'IN_PROGRESS',
            'importance' => 4,
            'deadline' => Carbon::now()->addDays(3), // Deadline in 3 days
        ]);

        Task::create([
            'title' => 'Task 3',
            'description' => 'Description for task 3',
            'status' => 'COMPLETED',
            'importance' => 2,
            'deadline' => Carbon::now()->addDays(7), // Deadline in 7 days
        ]);

        Task::create([
            'title' => 'Task 4 (Overdue)',
            'description' => 'Description for overdue task',
            'status' => 'TODO',
            'importance' => 5,
            'deadline' => Carbon::now()->subDays(1), // Overdue task
        ]);
    }
}
