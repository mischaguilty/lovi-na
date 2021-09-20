<?php

namespace App\Models\Traits;

use App\Models\ImportablesColumns;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait SourceColumns
{
    public function importables_columns(): MorphMany
    {
        return  $this->morphMany(ImportablesColumns::class, 'importable');
    }
}
