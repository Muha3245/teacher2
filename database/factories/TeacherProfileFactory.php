<?php

namespace Database\Factories;
use App\Models\TeacherProfile;
use App\Models\User;
use App\Models\Location;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TeacherProfile>
 */
class TeacherProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   
        protected $model = TeacherProfile::class;

    public function definition()
    {
        return [
            'profile_picture'   => 'teachers/default.png',
            'user_id'           => User::inRandomOrder()->first()?->id ?? User::factory(),
            'headline'          => $this->faker->sentence(6),
            'full_name'         => $this->faker->name(),
            'gender'            => $this->faker->randomElement(['male', 'female']),
            'birth_date'        => $this->faker->date('Y-m-d', '-25 years'),
            'address'           => $this->faker->address(),
            'location_id'       => Location::inRandomOrder()->first()?->id,
            'charge_period'     => $this->faker->randomElement(['hourly', 'monthly', 'weekly','daily']),
            'min_price'         => $this->faker->numberBetween(500, 2000),
            'max_price'         => $this->faker->numberBetween(2500, 6000),
            'years_teaching'    => $this->faker->numberBetween(1, 20),
            'years_online'      => $this->faker->numberBetween(0, 10),
            'willing_to_travel' => $this->faker->boolean(),
            'travel_km'         => $this->faker->numberBetween(0, 30),
            'has_digital_pen'   => $this->faker->boolean(),
            'helps_homework'    => $this->faker->boolean(),
            'opportunity'       => $this->faker->sentence(8),
            'profile_description'=> $this->faker->paragraph(5),
        ];
    }
    
}
