<?php

use Illuminate\Support\Facades\DB;
use App\Models\User;

beforeEach(function () {
    // Insert a user manually and authenticate
    $userId = DB::table('users')->insertGetId([
        'name' => 'Lucky Me',
        'email' => 'luckyme@example.com',
        'password' => Hash::make('password'),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $this->actingAs(User::find($userId));
});

it('can create a task', function () {
    $response = $this->post('/tasks', [
        'task_name' => 'Sample Task',
        'task_description' => 'This is a sample task',
        'category_id' => 1,
        'status_id' => 1,
    ]);

    $response->assertRedirect('/tasks');
    $this->assertDatabaseHas('tasks', ['task_name' => 'Sample Task']);
});

it('can update a task', function () {
    $taskId = DB::table('tasks')->insertGetId([
        'task_name' => 'Original Task',
        'task_description' => 'Original Description',
        'category_id' => 1,
        'status_id' => 2,
        'completion_date' => now()->addDays(5),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $response = $this->put("/tasks/{$taskId}", [
        'task_name' => 'Updated Task',
        'task_description' => 'Updated Description',
        'category_id' => 1,
        'status_id' => 1,
        'completion_date' => now()->addDays(5),
    ]);

    $response->assertRedirect('/tasks');
    $this->assertDatabaseHas('tasks', ['task_name' => 'Updated Task']);
});

it('can delete a task', function () {
    $taskId = DB::table('tasks')->insertGetId([
        'task_name' => 'Task to Delete',
        'task_description' => 'Description of task to delete',
        'category_id' => 1,
        'status_id' => 1,
        'completion_date' => now()->addDays(5),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $response = $this->delete("/tasks/{$taskId}");

    $response->assertRedirect('/tasks');
    $this->assertDatabaseMissing('tasks', ['id' => $taskId]);
});
