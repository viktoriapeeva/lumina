<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Upload>
 */
class UploadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'path' => 'uploads/' . $this->faker->word() . '.jpg',
            'type' => $this->faker->mimeType(),
            'name' => $this->faker->word(),
            'size' => $this->faker->randomNumber(),
            'likes' => $this->faker->randomNumber(),
            'saves' => $this->faker->randomNumber(),
            'shares' => $this->faker->randomNumber(),
            
        ];
    }
}
