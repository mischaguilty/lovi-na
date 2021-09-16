<?php

namespace App\Models;

use App\Models\Traits\MenuableTrait as Menuable;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Str;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use HasTranslations;
    use Menuable;

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

    public function getMenuableTypeAttribute()
    {
        return Product::class;
    }

    public bool $withDropdown = true;
}
