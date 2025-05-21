<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

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
        $photoPath = 'cats/'.$this->faker->uuid().'.jpeg';
        File::copy(
            public_path('storage/cats/default.jpeg'),
            public_path('storage/'.$photoPath)
        );

        return [
            'name' => $this->faker->firstName,
            'breed' => $this->faker->randomElement(['Siamese', 'Persian', 'Maine Coon', 'Bengal', 'Sphynx', 'Ragdoll']),
            'age' => $this->faker->numberBetween(0, 15),
            'vaccinated' => $this->faker->boolean(80),
            'photo' => $photoPath,
            'is_adopted' => false,
            'adopter_id' => null,
        ];
    }
}
