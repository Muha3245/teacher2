<?php

namespace Database\Factories;

use App\Models\StudentPosts;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentPostsFactory extends Factory
{
    protected $model = StudentPosts::class;

    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'location' => $this->faker->address(),
            'phone' => $this->faker->numerify('##########'),
            'country_code' => '+92',
            'description' => $this->faker->paragraph(3),
            
            // JSON Column: subjects (encoded as string)
            'subjects' => json_encode($this->faker->randomElements([
                'Mathematics', 'Physics', 'English', 'Computer Science', 'Chemistry'
            ], 2)),

            'levelText' => $this->faker->randomElement(['Grade 10', 'O-Levels', 'A-Levels', 'Undergraduate']),
            'jobType' => $this->faker->randomElement(['Part Time', 'Full Time', 'Contract']),
            'travel_distance' => $this->faker->numberBetween(1, 20),
            
            // Boolean Column: meeting_tutorplace (Migration expects boolean)
            'meeting_tutorplace' => $this->faker->boolean(),

            'budget' => $this->faker->randomFloat(2, 1000, 20000),
            'budgetType' => $this->faker->randomElement(['Monthly', 'Hourly', 'Per Subject']),
            'genderPreference' => $this->faker->randomElement(['Male', 'Female', 'Any']),
            'needSomeone' => $this->faker->randomElement(['Professional', 'Student', 'Expert']),
            
            // JSON Column: language (encoded as string)
            'language' => json_encode($this->faker->randomElements([
                'English', 'Urdu', 'Arabic', 'Punjabi'
            ], 1)),

            'getutorfrom' => $this->faker->randomElement(['home', 'online']),
            'files' => null, // Migration is string nullable
            
            // Integer Column: status (Migration expects unsignedInteger)
            // 0 = Pending, 1 = Active, 2 = Closed (example mapping)
            'status' => $this->faker->numberBetween(0, 2), 
            
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}