<?php

use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

beforeEach(function () {
    $this->taskService = new TaskService();
});

it('can update the status of a task', function () {
    $taskId = DB::table('tasks')->insertGetId([
        'task_name' => 'Original Task',
        'task_description' => 'Original Description',
        'category_id' => 1,
        'status_id' => 1,
        'completion_date' => now()->addDays(5),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $updatedTask = $this->taskService->updateTask($task, ['status_id' => 2]);

    expect($updatedTask->status_id)->toBe(2);
});

it('can create a new task', function () {
    $taskData = [
        'task_name' => 'New Task',
        'task_description' => 'Task description',
        'category_id' => 1,
        'status_id' => 1,
        'completion_date' => now()->addDays(3),
    ];

    $task = $this->taskService->createTask($taskData);

    expect($task->task_name)->toBe('New Task');
    $this->assertDatabaseHas('tasks', ['task_name' => 'New Task']);
});
