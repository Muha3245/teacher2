<?php

namespace App\Http\Controllers;

use App\Models\StudentPosts;
use Illuminate\Http\Request;
use App\Models\TeacherProfile;

class HomeController extends Controller
{
    public function ShowTeacherProfile( $id)
    {
        $profile = TeacherProfile::with(['subjects', 'educations', 'phones', 'location'])
                ->findOrFail($id);
                
        return view("pages.teacherprofile", compact("profile"));
    }

    public function studensinglepost($id)
    {
        $singlepost = StudentPosts::with('user')->findOrFail($id);
        return view('singlepost', compact('singlepost'));
    }
}
