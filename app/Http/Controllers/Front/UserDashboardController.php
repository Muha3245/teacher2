<?php

namespace App\Http\Controllers\Front;

use App\Models\StudentPosts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UserDashboardController extends Controller
{
    public function index()
    {
        return view('pages.userdash.dashboard');
    }
    public function create()
    {
        return view('pages.userdash.partials.createpost');
    
    }
    public function PostStore(Request $request)
    {
        $request->validate([
            'description' => 'required|string|min:20|max:1000',
            'location' => 'nullable|string|max:255',
            'phone' => 'required|string|max:20',
            'country_code' => 'required|string|max:5',
            'subjects' => 'required|string|max:255',
            'levelText' => 'nullable|string|max:255',
            'jobType' => 'nullable|string|in:Online,In-Person,Both',
            'travel_distance' => 'nullable|integer|min:0|max:100',
            'meeting_tutorplace' => 'nullable|boolean',
            'budget' => 'nullable|numeric|min:0',
            'budgetType' => 'nullable|string|in:Hourly,Monthly',
            'genderPreference' => 'nullable|string|in:NO_PREFERENCE,ONLY_MALE,ONLY_FEMALE',
            'needSomeone' => 'nullable|string|in:Urgently,In a week,In a month,Flexible',
            'languages' => 'nullable|array',
            'languages.*' => 'string|max:50',
            'getutorfrom' => 'nullable|string|in:Anywhere,"My city"',
            'files' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ]);

        // Handle file upload
        $fileName = null;
        if ($request->hasFile('files')) {
            $file = $request->file('files');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/student_files', $fileName); // store in storage/app/public/student_files
        }

        // Save to DB
        $studentPost = StudentPosts::create([
            'user_id' => $request->user_id,
            'description' => $request->description,
            'location' => $request->location,
            'phone' => $request->phone,
            'country_code' => $request->country_code,
            'subjects' => json_encode([$request->subjects]), // encode single subject as array
            'levelText' => $request->levelText,
            'jobType' => $request->jobType,
            'travel_distance' => $request->travel_distance,
            'meeting_tutorplace' => $request->meeting_tutorplace ? 1 : 0,
            'budget' => $request->budget,
            'budgetType' => $request->budgetType,
            'genderPreference' => $request->genderPreference,
            'needSomeone' => $request->needSomeone,
            'language' => json_encode($request->languages), // encode languages array
            'getutorfrom' => $request->getutorfrom,
            'files' => $fileName,
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Requirement posted successfully!');
    }

    public function EditStore($id)
    {
        $post = StudentPosts::where('id', $id)->first();

        // dd($post);
        return view('pages.userdash.partials.editpost', compact('post'));
    }

    public function PostUpdate(Request $request, $id)
    {
        // dd($request->all());
        
        // dd($validaiton);


        $post = StudentPosts::findOrFail($id);

        // Handle file upload
            if ($request->hasFile('files')) {

                // delete old file
                if ($post->files && Storage::exists('public/student_files/'.$post->files)) {
                    Storage::delete('public/student_files/'.$post->files);
                }

                // store new file
                $file = $request->file('files');
                $fileName = time().'_'.$file->getClientOriginalName();
                $file->storeAs('student_files', $fileName, 'public');

                $post->files = $fileName;
            }

        $post->update([
            'user_id' => $request->user_id,
            'description' => $request->description,
            'location' => $request->location,
            'phone' => $request->phone,
            'country_code' => $request->country_code,
            'subjects' => json_encode([$request->subjects]),
            'levelText' => $request->levelText,
            'jobType' => $request->jobType,
            'travel_distance' => $request->travel_distance,
            'meeting_tutorplace' => $request->meeting_tutorplace ? 1 : 0,
            'budget' => $request->budget,
            'budgetType' => $request->budgetType,
            'genderPreference' => $request->genderPreference,
            'needSomeone' => $request->needSomeone,
            'language' => json_encode($request->languages),
            'getutorfrom' => $request->getutorfrom,
            'files' => $fileName ?? $post->files,
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Requirement updated successfully!');
    }
}
