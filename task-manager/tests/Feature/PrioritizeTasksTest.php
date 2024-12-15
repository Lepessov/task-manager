<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PrioritizeTasksTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that tasks are prioritized correctly.
     *
     * @return void
     */
    public function test_it_prioritizes_tasks_correctly()
    {
        $task1 = Task::create([
            'title' => 'Task 1',
            'description' => 'Task 1 description',
            'status' => 'TODO',
            'importance' => 3,
            'deadline' => now()->addDays(5), // 5 days until deadline
        ]);

        $task2 = Task::create([
            'title' => 'Task 2',
            'description' => 'Task 2 description',
            'status' => 'TODO',
            'importance' => 5,
            'deadline' => now()->addDays(3), // 3 days until deadline
        ]);

        $task3 = Task::create([
            'title' => 'Task 3',
            'description' => 'Task 3 description',
            'status' => 'TODO',
            'importance' => 4,
            'deadline' => now()->addDays(7), // 7 days until deadline
        ]);

        $response = $this->getJson('/api/tasks/priority');

        $response->assertOk();

        $tasks = $response->json('data');


        $this->assertEquals($task2->id, $tasks[0]['id']); // Task 2 should have the highest priority
        $this->assertEquals($task1->id, $tasks[1]['id']); // Task 3 should come next
        $this->assertEquals($task3->id, $tasks[2]['id']); // Task 1 should have the lowest priority
    }
}
