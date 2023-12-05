<?php
namespace Modules\Blogs\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Blogs\Models\Blog;

class BlogFactory extends Factory
{
    protected $model = Blog::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name()
        ];
    }
}