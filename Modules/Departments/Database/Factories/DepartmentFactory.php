<?php
namespace Modules\Departments\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Departments\Models\Department;

class DepartmentFactory extends Factory
{
    protected $model = Department::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name()
        ];
    }
}