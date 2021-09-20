<?php

namespace App\Models;

use App\Models\Traits\Importable;
use App\Models\Traits\MenuableTrait as Menuable;
use App\Models\Traits\SourceColumns;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Str;

class Product extends Model implements HasMedia, Importable
{
    use HasFactory;
    use InteractsWithMedia;
    use HasTranslations;
    use Menuable;
    use SourceColumns;

    public array $translatable = [
        'name'
    ];

    protected $guarded = [];

    public function migration(Blueprint $table)
    {
        $table->id();
        $table->string('code')->nullable();
        $table->text('name');
        $table->timestamps();
    }

    public function definition(Generator $faker)
    {
        $job = Factory::create('ru_RU')->unique()->jobTitle();

        $name = [
            'ru' => $job,
            'uk' => $job,
            'en' => ucfirst(Str::slug($job)),
        ];

        return [
            'name' => $name,
            'code' => $faker->uuid,
        ];
    }

    public function getMenuableTypeAttribute(): string
    {
        return Product::class;
    }

    public function getImportablesAttribute(): array
    {
        return [
            'name', 'code',
        ];
    }

    public bool $withDropdown = true;
}
