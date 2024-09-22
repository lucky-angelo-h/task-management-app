<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Models\TaskCategory;
use App\Models\TaskStatuses;
use App\Services\TaskService;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\TaskUpdateStatusRequest;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function dashboard()
    {
        $tasksPerStatus = TaskStatuses::withCount('tasks')->get();

        $tasksPerCategory = TaskCategory::withCount('tasks')->get();

        return view('dashboard', compact('tasksPerStatus', 'tasksPerCategory'));
    }

    
    public function list()
    {
        $statuses = TaskStatuses::with('tasks')->get();

        return view('tasks.index', compact('statuses'));
    }

    
    public function create()
    {
        $categories = TaskCategory::all();
        $statuses = TaskStatuses::all();

        return view('tasks.create', compact('categories', 'statuses'));
    }

    
    public function store(TaskRequest $request)
    {
        $this->taskService->createTask($request->validated());

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    
    public function edit(Tasks $task)
    {
        $categories = TaskCategory::all();
        $statuses = TaskStatuses::all();

        return view('tasks.edit', compact('task', 'categories', 'statuses'));
    }

    
    public function update(TaskRequest $request, Tasks $task)
    {
        $this->taskService->updateTask($task, $request->validated());

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    public function updateStatus(TaskUpdateStatusRequest $request, Tasks $task)
    {
        $this->taskService->updateTaskStatus($task, $request->validated());

        return redirect()->back()->with('success', 'Task status updated successfully!');
    }

    
    public function destroy(Tasks $task)
    {
        $this->taskService->deleteTask($task);

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }
}