<?php
namespace Modules\FsiMenuItems\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\FsiMenuItems\Models\FsiMenuItem;

class FsiMenuItemFactory extends Factory
{
    protected $model = FsiMenuItem::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name()
        ];
    }
}