<?php

namespace App\Models;

use Faker\Factory;
use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Str;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use HasTranslations;

    public $translatable = [
        'name'
    ];

    protected $guarded = [];

    public function migration(Blueprint $table)
    {
        $table->id();
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
        ];
    }
}
