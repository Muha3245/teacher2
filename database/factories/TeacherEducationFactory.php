<?php

namespace Database\Factories;

use App\Models\TeacherEducation;
use App\Models\Education;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherEducationFactory extends Factory
{
    protected $model = TeacherEducation::class;

    public function definition()
    {
        return [
            'education_id'  => Education::inRandomOrder()->first()->id,
            'field'         => $this->faker->randomElement([
                'Computer Science',
                'Mathematics',
                'Physics',
                'Chemistry',
                'English',
                'Education'
            ]),
            'institution'   => $this->faker->company() . ' University',
            'year_completed'=> $this->faker->year(),
        ];
    }
}
