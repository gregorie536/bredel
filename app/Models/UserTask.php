<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'task_id',
    ];

    /**
     * Get the user that owns the user task.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the task that owns the user task.
     */
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
