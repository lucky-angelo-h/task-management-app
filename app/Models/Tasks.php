<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'task_name',
        'task_description',
        'category_id',
        'status_id',
        'completion_date',
        'updated_at',
        'created_at'
    ];

    // Relationship with TaskCategory
    public function category()
    {
        return $this->belongsTo(TaskCategory::class);
    }

    // Relationship with TaskStatus
    public function status()
    {
        return $this->belongsTo(TaskStatuses::class);
    }
}
