<?php
namespace Modules\Subjects\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Subjects\Models\Subject;

class SubjectFactory extends Factory
{
    protected $model = Subject::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name()
        ];
    }
}