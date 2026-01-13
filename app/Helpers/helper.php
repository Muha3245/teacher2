<?php

use App\Models\User;
use App\Models\TeacherProfile;
use App\Models\TeacherPhone;
use App\Models\TeacherEducation;
use App\Models\TeacherSubjects;

function TeacherProfile()
{
    $profile = TeacherProfile::with('subjects', 'educations', 'phones')->get();
    return $profile;
}