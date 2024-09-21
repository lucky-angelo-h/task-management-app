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
        // var_dump($data);
        if((int)$data['status_id'] == 4) {
          $data['completion_date'] = date('Y-m-d H:i:s');
        }
        $task->update($data);
        return $task;
    }

    
    public function deleteTask(Tasks $task): void
    {
        $task->delete();
    }

    public function setMemberTask(array $data): MemberTasks 
    {
        return MemberTask::create([
          'task_id' => $data['task_id'], 
          'member_id' => $data['member_id']
        ]);
    }
}