<?php

namespace Database\Factories\UI;

use App\Models\UI\Content;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContentFactory extends Factory
{
    protected $model = Content::class;

    public function definition()
    {
        return app($this->model)->definition($this->faker);
    }
}
