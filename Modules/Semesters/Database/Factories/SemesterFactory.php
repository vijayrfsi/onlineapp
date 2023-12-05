<?php
namespace Modules\Semesters\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Semesters\Models\Semester;

class SemesterFactory extends Factory
{
    protected $model = Semester::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name()
        ];
    }
}