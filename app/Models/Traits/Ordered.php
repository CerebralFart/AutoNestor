<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Ordered {
    public static function bootOrdered() {
        static::addGlobalScope('ordered', function (Builder $builder) {
            $builder->orderBy(self::$orderBy ?? 'created_at');
        });
    }
}
