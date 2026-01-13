<?php

namespace Database\Factories;

use App\Models\TeacherPhone;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherPhoneFactory extends Factory
{
    protected $model = TeacherPhone::class;

    public function definition()
    {
        return [
            'country_code' => '+92',
            'phone'        => $this->faker->numerify('3#########'),
            'is_primary'   => false,
        ];
    }
}
