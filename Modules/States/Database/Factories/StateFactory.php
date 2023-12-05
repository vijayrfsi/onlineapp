<?php
namespace Modules\States\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\States\Models\State;

class StateFactory extends Factory
{
    protected $model = State::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name()
        ];
    }
}