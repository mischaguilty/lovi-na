<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasPosition
{
    public function scopeOrdered(Builder $builder): Builder
    {
        return $builder->orderBy('position');
    }
}
