<?php

use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\Sanctum;
use App\Models\User;

beforeEach(function () {
    $userId = DB::table('users')->insertGetId([
        'name' => 'Lucky Me',
        'email' => 'luckyme@example.com',
        'password' => Hash::make('password'),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    Sanctum::actingAs(User::find($userId));
});

it('can create a task via the API', function () {

    $response = $this->postJson('/api/tasks', [
        'task_name' => 'Sample Task',
        'task_description' => 'This is a sample task',
        'category_id' => 1,
    ]);

    $response->assertStatus(201);
    $this->assertDatabaseHas('tasks', ['task_name' => 'Sample Task']);
});

it('can update a task via the API', function () {
    $taskId = DB::table('tasks')->insertGetId([
        'task_name' => 'Original Task',
        'task_description' => 'Original Description',
        'category_id' => 1,
        'status_id' => 2,
        'completion_date' => now()->addDays(5),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $response = $this->putJson("/api/tasks/{$taskId}", [
        'task_name' => 'Updated Task',
        'task_description' => 'Updated Description',
        'category_id' => 1,
        'status_id' => 1,
        'completion_date' => now()->addDays(5),
    ]);

    $response->assertStatus(200);
    $this->assertDatabaseHas('tasks', ['task_name' => 'Updated Task']);
});

it('can delete a task via the API', function () {
    $taskId = DB::table('tasks')->insertGetId([
        'task_name' => 'Task to Delete',
        'task_description' => 'Description of task to delete',
        'category_id' => 1,
        'status_id' => 1,
        'completion_date' => now()->addDays(5),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $response = $this->deleteJson("/api/tasks/{$taskId}");

    $response->assertStatus(200);
    $this->assertDatabaseMissing('tasks', ['id' => $taskId]);
});
