<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskStatuses extends Model
{
    use HasFactory;

    protected $table = 'task_statuses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status_name',
    ];

    public function tasks()
    {
        return $this->hasMany(Tasks::class, 'status_id');
    }
}
