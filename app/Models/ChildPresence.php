<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildPresence extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_id',
        'present',
    ];

    public function child()
    {
        return $this->belongsTo(Child::class);
    }
}
