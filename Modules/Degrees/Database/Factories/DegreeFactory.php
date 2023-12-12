<?php
namespace Modules\Degrees\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Degrees\Models\Degree;

class DegreeFactory extends Factory
{
    protected $model = Degree::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name()
        ];
    }
}