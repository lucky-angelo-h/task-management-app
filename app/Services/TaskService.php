<?php

namespace App\Services;

use App\Models\Tasks;
use App\Models\MemberTasks;

class TaskService
{
    
    public function createTask(array $data): Tasks
    {
        return Tasks::create($data);
    }

    
    public function updateTask(Tasks $task, array $data): Tasks
    {
        $task->update($data);
        return $task;
    }

    public function updateTaskStatus(Tasks $task, array $data): Tasks
    {
        $completion_date = null;
        if((int)$data['status_id'] == 4) {
          $completion_date = date('Y-m-d H:i:s');
        }
        
        $task->update([
            'status_id' => $data['status_id'],
            'completion_date' => $completion_date,
        ]);
        return $task;
    }
    
    public function deleteTask(Tasks $task): void
    {
        $task->delete();
    }
}