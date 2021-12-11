<?php

namespace App\Models;

use App\Models\Traits\Ordered;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property-read Collection|Assignment[] $assignments
 * @property-read Collection|User[] $vetoers
 * @property string $name
 * @property string|null $description
 * @property boolean $is_supervision
 */
class Task extends Model {
    use Ordered;

    public static $orderBy = 'name';
    
    protected $fillable = [
        'name',
        'description',
        'is_supervision'
    ];
    protected $casts = [
        'is_supervision' => 'boolean'
    ];

    public function assignments() {
        return $this->hasMany(Assignment::class);
    }

    public function vetoers() {
        return $this->belongsToMany(User::class, 'vetos');
    }
}
