<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TeacherProfile;
use App\Models\Subject;
use App\Models\Education;

class TeacherProfileSeeder extends Seeder
{
    public function run()
    {
        TeacherProfile::factory()
            ->count(50)
            ->create()
            ->each(function ($teacher) {

                // --- Subjects (2–4 unique subjects per teacher) ---
                $subjectIds = Subject::pluck('id')->shuffle()->take(rand(2,4));
                foreach ($subjectIds as $subjectId) {
                    $teacher->subjects()->create([
                        'subject_id' => $subjectId,
                        'from_level' => rand(1,5),
                        'to_level'   => rand(6,12),
                    ]);
                }

                // --- Educations (1–3 unique educations per teacher) ---
                $educationIds = Education::pluck('id')->shuffle()->take(rand(1,3));
                foreach ($educationIds as $educationId) {
                    $teacher->educations()->create([
                        'education_id'  => $educationId,
                        'field'         => fake()->word() . ' Studies',
                        'institution'   => fake()->company() . ' University',
                        'year_completed'=> rand(2000, 2025),
                    ]);
                }

                // --- Phones (1 primary + 0–2 additional) ---
                $teacher->phones()->create([
                    'country_code' => '+92',
                    'phone'        => '3' . rand(100000000, 999999999),
                    'is_primary'   => true,
                ]);

                // optional extra phones
                $extraPhones = rand(0,2);
                for ($i=0; $i<$extraPhones; $i++) {
                    $teacher->phones()->create([
                        'country_code' => '+92',
                        'phone'        => '3' . rand(100000000, 999999999),
                        'is_primary'   => false,
                    ]);
                }

            });
    }
}
