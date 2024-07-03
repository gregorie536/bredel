<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'morning', 'noon', 'evening', 'date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
