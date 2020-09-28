<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->words($this->faker->numberBetween(2, 5), true),
            'short_desc' => $this->faker->realText($this->faker->numberBetween(150, 250)),
            'text' => $this->faker->realText($this->faker->numberBetween(2000, 3000)),
            'published' => $this->faker->numberBetween(1, 5) > 1,
            'image' => $this->faker->imageUrl(640, 480)
        ];
    }
}
