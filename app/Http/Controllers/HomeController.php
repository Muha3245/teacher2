<?php

namespace App\Http\Controllers;

use App\Models\CoinHistory;
use App\Models\StudentPosts;
use Illuminate\Http\Request;
use App\Models\TeacherProfile;

class HomeController extends Controller
{
    public function ShowTeacherProfile($id)
    {
        $profile = TeacherProfile::with(['subjects', 'educations', 'phones', 'location'])
            ->findOrFail($id);

        return view("pages.teacherprofile", compact("profile"));
    }

    public function studensinglepost(Request $request, $id)
    {
        if ($request->has('nid')) {
            $notification = auth()->user()
                ->notifications()
                ->where('id', $request->nid)
                ->first();

            if ($notification) {
                $notification->markAsRead();
            }
        }


        $singlepost = StudentPosts::with('user')->findOrFail($id);
        $coinHistory = CoinHistory::where('user_id', auth()->user()->id)
            ->where('student_post_id', $id)
            ->where('type', 'deduction')
            ->first();

        if ($coinHistory) {
            $coin = 'Paid';
        } else {
            $coin = number_format($singlepost->budget * 0.01, 2);
        }
        return view('singlepost', compact('singlepost', 'coin'));
    }
}
