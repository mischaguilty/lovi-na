<?php

namespace App\Models\UI;

use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

class Section extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function migration(Blueprint $table)
    {
        $table->id();
        $table->timestamp('created_at')->nullable();
        $table->timestamp('updated_at')->nullable();
    }

    public function definition(Generator $faker)
    {
        return [
            'name' => $faker->name(),
            'created_at' => $faker->dateTimeThisMonth(),
        ];
    }
}
