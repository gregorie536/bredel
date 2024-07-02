<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'created_by',
        'is_assigned',
        'user_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (auth()->check()) {
                $model->created_by = auth()->id();
            }
        });

      

        static::saved(function ($model) {
            if ($model->is_assigned && $model->user_id) {
                UserTask::updateOrCreate(
                    ['user_id' => $model->user_id, 'task_id' => $model->id],
                    ['user_id' => $model->user_id, 'task_id' => $model->id]
                );
            } else {
                UserTask::where('task_id', $model->id)->delete();
                $model->is_assigned = false;
                $model->saveQuietly();
            }
        });
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function userTasks()
    {
        return $this->hasMany(UserTask::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
