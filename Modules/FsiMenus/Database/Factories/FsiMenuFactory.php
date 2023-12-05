<?php
namespace Modules\FsiMenus\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\FsiMenus\Models\FsiMenu;

class FsiMenuFactory extends Factory
{
    protected $model = FsiMenu::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name()
        ];
    }
}