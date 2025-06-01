<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cat>
 */
class CatFactory extends Factory
{
    protected array $testPhotos = [
        'cat-1.jpg',
        'cat-2.jpg',
        'cat-3.jpg',
        'cat-4.jpg',
        'cat-5.jpg',
        'cat-6.jpg',
        'cat-7.jpg',
        'cat-8.jpg',
    ];
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $photoPath = 'cats/'.$this->faker->uuid().'.jpg';
        File::copy(
            public_path('storage/cats/test/'.$this->faker->randomElement($this->testPhotos)),
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
