<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function authorize()
    {
        return true; // You can add more logic to authorize the request
    }

    public function rules()
    {
        return [
            'task_name' => 'required|string|max:255',
            'task_description' => 'required|string|max:255',
            'category_id' => 'nullable|exists:task_category,id',
            'status_id' => 'sometimes|exists:task_statuses,id',
            'completion_date' => 'sometimes|date',
        ];
    }
}
