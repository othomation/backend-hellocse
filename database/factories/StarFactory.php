<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Star>
 */
class StarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "firstname" => fake()->firstName(),
            "lastname" => fake()->lastName(),
            /** 
             * Use the default image every time!
             */
            "image" => asset('storage/default_star_image.jpg'),
            "description" => fake()->sentences(random_int(2, 4), true)
        ];
    }
}
