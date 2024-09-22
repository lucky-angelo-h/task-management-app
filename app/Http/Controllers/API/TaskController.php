<?php

namespace App\Http\Controllers\API;

use App\Models\Tasks;
use App\Services\TaskService;
use App\Http\Requests\TaskRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskUpdateStatusRequest;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        $tasks = Tasks::all();

        return response()->json($tasks, 200);
    }

    public function store(TaskRequest $request)
    {
        $task = $this->taskService->createTask($request->validated());

        return response()->json($task, 201);
    }

    public function show($id)
    {
        $task = Tasks::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        return response()->json($task, 200);
    }

    public function update(TaskRequest $request, $id)
    {
        $task = Tasks::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $updatedTask = $this->taskService->updateTask($task, $request->validated());

        return response()->json($updatedTask, 200);
    }

    public function destroy($id)
    {
        $task = Tasks::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $this->taskService->deleteTask($task);

        return response()->json(['message' => 'Task deleted'], 200);
    }

    public function updateStatus(TaskUpdateStatusRequest $request, $id)
    {
        $task = Tasks::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $this->taskService->updateTaskStatus($task, $request->validated());

        return response()->json(['message' => 'Task status updated'], 200);
    }
}
