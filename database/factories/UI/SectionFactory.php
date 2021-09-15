<?php

namespace Database\Factories\UI;

use App\Models\UI\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

class SectionFactory extends Factory
{
    protected $model = Section::class;

    public function definition()
    {
        return app($this->model)->definition($this->faker);
    }
}
