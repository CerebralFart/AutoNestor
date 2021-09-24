<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

/**
 * @property-read int $id
 * @property-read Collection|Assignment[] $assignments
 * @property-read Collection|Task[] $vetos
 * @property string $name
 * @property string $email
 * @property string $role
 */
class User extends Authenticatable {
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute(?string $value) {
        $this->attributes['password'] = $value ? Hash::make($value) : null;
    }

    public function setRoleAttribute(string $value) {
        if (in_array($value, ['user', 'admin'])) {
            $this->attributes['role'] = $value;
        } else {
            throw new Exception(sprintf("Role [%s] is invalid, must be one of (user, admin)", $value));
        }
    }

    public function assignmentForWeek(Week $week): ?Assignment {
        return $this->assignments()->where('week_id', $week->id)->first();
    }

    public function assignments() {
        return $this->hasMany(Assignment::class);
    }

    public function vetos() {
        return $this->belongsToMany(Task::class, 'vetos');
    }
}
