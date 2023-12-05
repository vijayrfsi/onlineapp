<?php
namespace Modules\Makes\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Makes\Models\Make;

class MakeFactory extends Factory
{
    protected $model = Make::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name()
        ];
    }
}