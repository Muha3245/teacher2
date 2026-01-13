<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [
            'Mathematics',
            'Physics',
            'Chemistry',
            'Biology',
            'English Language',
            'English Literature',
            'Computer Science',
            'Information Technology',
            'Software Engineering',
            'Data Science',
            'Artificial Intelligence',
            'Machine Learning',
            'Cyber Security',
            'Web Development',
            'Mobile App Development',
            'Economics',
            'Accounting',
            'Business Studies',
            'Marketing',
            'Finance',
            'Statistics',
            'History',
            'Geography',
            'Political Science',
            'Psychology',
            'Sociology',
            'Islamic Studies',
            'Philosophy',
            'Environmental Science',
        ];

        foreach ($subjects as $subject) {
            Subject::firstOrCreate([
                'name' => $subject
            ]);
        }
    }
}
