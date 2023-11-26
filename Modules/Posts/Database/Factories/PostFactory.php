<?php
namespace Modules\Posts\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Posts\Models\Post;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name()
        ];
    }
}