<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\TeacherProfile;
use App\Models\StudentPosts;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class TeacherSearchController extends Controller
{
    public function TeacherPosts()
    {
        $teacherprofile = TeacherProfile::with('subjects.subject')->get();
        return view('allposts', compact('teacherprofile'));
    }
    public function StudentPosts()
    {
        $studentposts = StudentPosts::with('user')->get();
        return view('studentpost', compact('studentposts'));
    }


    public function index(Request $request)
    {
        // dd($request->all());
        $query = TeacherProfile::query()
            ->with(['subjects.subject', 'location']);

        if ($request->filled('subject')) {
            $query->whereHas('subjects.subject', function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->subject . '%');
            });
        }

        if ($request->filled('location')) {
            $query->where('location', 'LIKE', '%' . $request->location . '%');
        }


        $teachers = $query->paginate(12);

        return view('pages.search.results', compact('teachers'));
    }

    public function searchTeachers(Request $request)
    {
        $query = TeacherProfile::with('subjects.subject');

        if ($request->filled('tag') && $request->tag !== 'all') {
            match ($request->tag) {
                'online' => $query->where('years_online', '>', 0),
                'home' => $query->where('willing_to_travel', 1),
                'assignment' => $query->where('helps_homework', 1),
            };
        }

        if ($request->filled('subject')) {
            $query->whereHas(
                'subjects.subject',
                fn($q) =>
                $q->where('name', $request->subject)
            );
        }

        $teacherprofile = $query->get();

        if ($request->ajax()) {
            return view('allposts', compact('teacherprofile'))->render();
        }

        return view('allposts', compact('teacherprofile'));
    }
    public function searchStudent(Request $request)
    {
        $query = StudentPosts::with('user');

        if ($request->filled('tag') && $request->tag !== 'all') {
            match ($request->tag) {
                'online' => $query->where('getutorfrom', '=', 'online'),
                'home' => $query->where('getutorfrom', '=', 'home'),
                'assignment' => $query->where('getutorfrom', '=', 'assignment'),
            };
        }

        

        $studentposts = $query->get();

        if ($request->ajax()) {
            return view('studentpost', compact('studentposts'))->render();
        }

        return view('studentpost', compact('studentposts'));
    }
    public function SinglePosts($id)
    {
        $post = StudentPosts::with('user','comments')->findOrFail($id);
        return view('pages.userdash.singlepost', compact('post'));
    }
}
