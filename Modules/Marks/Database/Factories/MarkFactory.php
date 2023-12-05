<?php
namespace Modules\Marks\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Marks\Models\Mark;

class MarkFactory extends Factory
{
    protected $model = Mark::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name()
        ];
    }
}