<?php

namespace App\Models;

use Faker\Generator;
use Helldar\LaravelLangPublisher\Facades\Locales;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Company extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use HasTranslations;

    public $translatable = [
        'name',
    ];


    protected $guarded = [];

    public function migration(Blueprint $table)
    {
        $table->id();
        $table->text('name');
        $table->timestamp('created_at')->nullable();
        $table->timestamp('updated_at')->nullable();
    }

    public function definition(Generator $faker)
    {
        return [
            'created_at' => $faker->dateTimeThisMonth(),
            'name' => array_combine(Locales::installed(), array_pad([], count(Locales::installed()), $faker->company())),
        ];
    }
}
