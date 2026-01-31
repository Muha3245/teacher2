<?php

namespace Database\Seeders;

use App\Models\StudentPosts;
use Illuminate\Database\Seeder;

class StudentPostsSeeder extends Seeder
{
    public function run(): void
    {
        // Generates 20 fake student posts
        StudentPosts::factory()->count(20)->create();
    }
}