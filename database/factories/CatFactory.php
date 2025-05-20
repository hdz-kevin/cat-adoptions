<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cat>
 */
class CatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName,
            'breed' => $this->faker->randomElement(['Siamese', 'Persian', 'Maine Coon', 'Bengal', 'Sphynx', 'Ragdoll']),
            'age' => $this->faker->numberBetween(0, 15),
            'vaccinated' => $this->faker->boolean(80),
            'photo' => 'default.webp',
            'is_adopted' => false,
            'adopter_id' => null,
        ];
    }
}
