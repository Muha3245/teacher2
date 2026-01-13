<?php

namespace Database\Factories;

use App\Models\TeacherSubjects;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherSubjectsFactory extends Factory
{
    protected $model = TeacherSubjects::class;

    public function definition()
    {
        return [
            'subject_id' => Subject::inRandomOrder()->first()->id,
            'from_level' => $this->faker->numberBetween(1, 5),
            'to_level'   => $this->faker->numberBetween(6, 12),
        ];
    }
}
