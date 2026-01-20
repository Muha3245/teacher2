<?php

use App\Models\User;
use App\Models\TeacherProfile;
use App\Models\TeacherPhone;
use App\Models\TeacherEducation;
use App\Models\TeacherSubjects;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use App\Models\Education;

function TeacherProfile()
{
    $profile = TeacherProfile::with('subjects', 'educations', 'phones')->get();
    return $profile;
}
function SingelTeacherProfile($userId)
{
    if (!$userId) {
        return null;
    }
    $profile = TeacherProfile::where('user_id', $userId)->with('subjects', 'educations', 'phones')->first();
    return $profile;
}
function Educations()
{
    $educations = Education::all();
    return $educations;
}
function Subjects()
{
    $subjects = Subject::all();
    return $subjects;
}
function TeacherSubjects(){
    $subjects = TeacherSubjects::with('subject')->get();
    return $subjects;

}