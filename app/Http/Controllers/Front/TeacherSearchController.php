<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\TeacherProfile;
use App\Http\Controllers\Controller;

class TeacherSearchController extends Controller
{
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
}
