<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Education;

class EducationSeeder extends Seeder
{
    public function run(): void
    {
        $educations = [
            ['degree' => 'Secondary School Certificate (SSC)', ],
            ['degree' => 'Higher Secondary Certificate (HSC)', ],
            ['degree' => 'High School Diploma', ],
            ['degree' => 'Associate Degree', ],

            ['degree' => 'Bachelor of Arts (BA)', ],
            ['degree' => 'Bachelor of Science (BSc)', ],
            ['degree' => 'Bachelor of Commerce (BCom)', ],
            ['degree' => 'Bachelor of Business Administration (BBA)', ],
            ['degree' => 'Bachelor of Computer Science', ],
            ['degree' => 'Bachelor of Software Engineering',],
            ['degree' => 'Bachelor of Information Technology',],
            ['degree' => 'Bachelor of Education (B.Ed)',],

            ['degree' => 'Master of Arts (MA)',],
            ['degree' => 'Master of Science (MSc)',],
            ['degree' => 'Master of Commerce (MCom)',],
            ['degree' => 'Master of Business Administration (MBA)', ],
            ['degree' => 'Master of Computer Science',],
            ['degree' => 'Master of Information Technology', ],
            ['degree' => 'Master of Education (M.Ed)',],

            ['degree' => 'Doctor of Philosophy (PhD)',],
            ['degree' => 'Doctor of Philosophy (PhD)',],
            ['degree' => 'Doctor of Philosophy (PhD)',],

            ['degree' => 'Professional Teaching Certificate',],
            ['degree' => 'Diploma in Information Technology', ],
            ['degree' => 'Diploma in Computer Science', ],
            ['degree' => 'Diploma in Education', ],
        ];

        foreach ($educations as $education) {
            Education::firstOrCreate($education);
        }
    }
}
