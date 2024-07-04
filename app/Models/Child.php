<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'user_id',
        'couple_id',
        'name',
        'birthdate',
        'second_parent_id',
    ];

    public function couple()
    {
        return $this->belongsTo(User::class, 'couple_id');
    }

    public function secondParent()
    {
        return $this->belongsTo(User::class, 'second_parent_id');
    }
}
