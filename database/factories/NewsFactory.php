<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->words($this->faker->numberBetween(2, 5), true),
            'text' => $this->faker->realText($this->faker->numberBetween(500, 1500)),
            'short_desc' => $this->faker->realText($this->faker->numberBetween(200, 300)),
        ];
    }
}
