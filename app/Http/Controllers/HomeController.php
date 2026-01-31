<?php

namespace App\Http\Controllers;

use App\Models\TeacherProfile;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function ShowTeacherProfile( $id)
    {
        $profile = TeacherProfile::with(['subjects', 'educations', 'phones', 'location'])
                ->findOrFail($id);
                
        return view("pages.teacherprofile", compact("profile"));
    }
}
