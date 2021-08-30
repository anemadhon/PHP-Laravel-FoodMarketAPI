<?php

namespace Database\Factories;

use App\Models\Food;
use Illuminate\Database\Eloquent\Factories\Factory;

class FoodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Food::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(), 
            'ingredient' => $this->faker->words(4, true),
            'price' => $this->faker->randomNumber(5, true), 
            'rate' => $this->faker->numberBetween(1, 5),
            'type' => $this->faker->word()
        ];
    }
}
