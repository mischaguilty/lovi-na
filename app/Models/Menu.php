<?php

namespace App\Models;

use App\Models\Traits\Menuable;
use Faker\Generator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Schema\Blueprint;
use Spatie\Translatable\HasTranslations;

class Menu extends Model
{
    use HasTranslations;
    use HasFactory;

    public array $translatable = [
        'name'
    ];

    protected $guarded = [];

    public function migration(Blueprint $table)
    {
        $table->id();
        $table->text('name');
        $table->unsignedBigInteger('top_menu_id');
        $table->nullableMorphs('menuable', 'menuable_index');
        $table->unsignedInteger('position')->default(0);
        $table->timestamps();
    }

    public function definition(Generator $faker): array
    {
        return [];
    }

    public function menuable(): MorphTo
    {
        return $this->morphTo('menuable');
    }

    public function top()
    {
        return optional(self::query()->find($this->top_menu_id) ?? null, function (Menu $menu) {
            return $menu;
        });
    }

    public function children()
    {
        return Menu::query()->where([
            'menuable_type' => $this->menuable_type,
            'top_menu_id' => $this->getKey(),
        ])->orderBy('position')->get();
    }
}
