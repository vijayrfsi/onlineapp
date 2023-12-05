<?php
namespace Modules\Brands\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Brands\Models\Brand;

class BrandFactory extends Factory
{
    protected $model = Brand::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name()
        ];
    }
}