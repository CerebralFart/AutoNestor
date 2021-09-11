<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property-read Collection|Assignment[] $assignments
 * @property string $name
 * @property string|null $description
 */
class Task extends Model {
    protected $fillable = [
        'name',
        'description'
    ];

    public function assignments() {
        return $this->hasMany(Assignment::class);
    }

    public function vetos() {
        return $this->hasMany(Veto::class);
    }
}
