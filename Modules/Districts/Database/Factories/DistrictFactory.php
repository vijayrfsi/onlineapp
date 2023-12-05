<?php
namespace Modules\Districts\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Districts\Models\District;

class DistrictFactory extends Factory
{
    protected $model = District::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name()
        ];
    }
}