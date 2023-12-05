<?php
namespace Modules\Classes\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Classes\Models\Class;

class ClassFactory extends Factory
{
    protected $model = Class::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name()
        ];
    }
}