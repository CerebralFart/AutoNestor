<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

/**
 * @property-read int $id
 * @property-read Collection|Assignment[] $assignments
 * @property string $name
 * @property string $email
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

    public function assignmentForWeek(Week $week): ?Assignment {
        return $this->assignments()->where('week_id', $week->id)->first();
    }

    public function assignments() {
        return $this->hasMany(Assignment::class);
    }

    public function vetos() {
        return $this->hasMany(Veto::class);
    }
}
