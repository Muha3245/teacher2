<?php

namespace Database\Factories;
use App\Models\Languages;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Languages>
 */
class LanguagesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $languages = [
            "English", "Spanish", "Hindi", "Urdu", "Arabic", "Chinese",
            "French", "German", "Japanese", "Korean", "Russian",
            "Portuguese", "Bengali", "Turkish", "Italian", "Vietnamese",
            "Persian", "Polish", "Dutch", "Swahili", "Thai", "Greek",
            "Hebrew", "Indonesian", "Tamil", "Gujarati", "Punjabi"
            // Add more if you like
        ];

        return [
            'name' => $this->faker->unique()->randomElement($languages),
        ];
    }
}
