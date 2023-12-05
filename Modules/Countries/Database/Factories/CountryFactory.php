<?php
namespace Modules\Countries\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Countries\Models\Country;

class CountryFactory extends Factory
{
    protected $model = Country::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name()
        ];
    }
}