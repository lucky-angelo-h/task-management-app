<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Models\TaskCategory;
use App\Models\TaskStatuses;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function dashboard()
    {
        // Get task counts by status
        $tasksPerStatus = TaskStatuses::withCount('tasks')->get();

        // Get task counts by category
        $tasksPerCategory = TaskCategory::withCount('tasks')->get();

        return view('dashboard', compact('tasksPerStatus', 'tasksPerCategory'));
    }

    
    public function list()
    {
        // Fetch tasks with pagination, 10 per page
        $tasks = Tasks::paginate(10);

        // Return view with paginated tasks
        return view('tasks.index', compact('tasks'));
    }

    
    public function create()
    {
        // Fetch categories and statuses for dropdowns
        $categories = TaskCategory::all();
        $statuses = TaskStatuses::all();

        return view('tasks.create', compact('categories', 'statuses'));
    }

    
    public function store(Request $request)
    {
        $data = $request->validate([
            'task_name' => 'required|string|max:255',
            'task_description' => 'required|string|max:255',
            'category_id' => 'nullable|exists:task_category,id',
            'status_id' => 'sometimes|exists:task_statuses,id',
        ]);

        $this->taskService->createTask($data);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    
    public function edit(Tasks $task)
    {
        $categories = TaskCategory::all();
        $statuses = TaskStatuses::all();

        return view('tasks.edit', compact('task', 'categories', 'statuses'));
    }

    
    public function update(Request $request, Tasks $task)
    {
        $data = $request->validate([
            'task_name' => 'required|string|max:255',
            'task_description' => 'required|string|max:255',
            'category_id' => 'nullable|exists:task_category,id',
            'status_id' => 'sometimes|exists:task_statuses,id',
        ]);

        $this->taskService->updateTask($task, $data);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    
    public function destroy(Tasks $task)
    {
        $this->taskService->deleteTask($task);

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }
}