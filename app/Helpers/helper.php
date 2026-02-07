<?php

use App\Models\User;
use App\Models\TeacherProfile;
use App\Models\TeacherPhone;
use App\Models\TeacherEducation;
use App\Models\TeacherSubjects;
use App\Models\Subject;
use App\Models\Languages;
use Illuminate\Support\Facades\Auth;
use App\Models\Education;
use App\Models\StudentPosts;

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
function TeacherSubjects()
{
    $subjects = TeacherSubjects::with('subject')->get();
    return $subjects;
}
function Languages()
{
    $languages = Languages::all();
    return $languages;
}

function SingleStudentPost($userId)
{
    if (!$userId) {
        return null;
    }
    $studentposts = StudentPosts::where('user_id', $userId)->get();
    return $studentposts;
}

function spostnotify()
{
    $posts = StudentPosts::whereHas('comments', function ($query) {
        $query->whereNull('seen_at');
    })
        ->with(['comments' => function ($query) {
            $query->whereNull('seen_at');
        }])
        ->get();
    return $posts;
}
