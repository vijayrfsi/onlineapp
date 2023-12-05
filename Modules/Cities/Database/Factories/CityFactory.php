<?php
namespace Modules\Cities\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Cities\Models\City;

class CityFactory extends Factory
{
    protected $model = City::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name()
        ];
    }
}