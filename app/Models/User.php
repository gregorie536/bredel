<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'couple_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    /**
     * Get the tasks created by the user.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class, 'created_by');
    }

    /**
     * Get the user tasks for the user.
     */
    public function userTasks()
    {
        return $this->hasMany(UserTask::class);
    }

    public function couple()
    {
        return $this->belongsTo(User::class, 'couple_id');
    }

    public function partners()
    {
        return $this->hasMany(User::class, 'couple_id');
    }

    public function children()
    {
        return $this->hasMany(Child::class);
    }
}
