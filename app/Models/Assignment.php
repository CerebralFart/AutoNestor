<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property Task $task
 * @property User $user
 * @property Week $week
 */
class Assignment extends Model {
    protected $fillable = [
        'task_id',
        'user_id',
        'week_id'
    ];

    public function task() {
        return $this->belongsTo(Task::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function week() {
        return $this->belongsTo(Week::class);
    }
}
