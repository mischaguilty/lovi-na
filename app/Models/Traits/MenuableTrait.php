<?php

namespace App\Models\Traits;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

trait MenuableTrait
{
    public function menu(): MorphOne
    {
        return $this->morphOne(Menu::class, 'menuable');
    }

    public function topMenuItem()
    {
        return optional(Menu::query()->firstOrCreate([
                    'menuable_type' => self::class,
                    'menuable_id' => 0,
                    'top_menu_id' => 0,
                ], [
                    'name' => optional(LaravelLocalization::getSupportedLanguagesKeys() ?? null, function (array $locales) {
                        return array_combine($locales, collect($locales)->map(function (string $locale) {
                            return optional(explode('\\', self::class) ?? null, function (array $parts) use ($locale) {
                                return optional(collect($parts)->last() ?? null, function (string $part) use ($locale) {
                                    return trans($part, [], $locale);
                                });
                            });
                        })->toArray());
                    }),
                ]) ?? null, function (Menu $top) {
                return $top;
            }) ?? null;
    }

    protected static function bootMenuableTrait()
    {
        static::saved(function ($model) {
            $top = $model->topMenuItem();
            if ($top->exists && $model->withDropdown) {
                $menu = optional($model->wasRecentlyCreated ? $model->menu()->create([
                    'name' => $model->getAttributeValue('name'),
                    'top_menu_id' => optional($top ?? null, function (Menu $top) {
                            return $top->getKey();
                        }) ?? 0,
                ]) : null, function (Menu $menu) {
                    return $menu;
                });
            }
        });
    }
}
