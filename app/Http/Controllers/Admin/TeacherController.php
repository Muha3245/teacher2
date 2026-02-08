<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subject;
use App\Models\Location;
use App\Models\Education;
use App\Models\Connection;
use App\Models\CoinHistory;
use Illuminate\Http\Request;
use App\Models\TeacherProfile;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = TeacherProfile::get();
        return view('admin.teacher.index', compact('teachers'));
    }

    public function create()
    {
        $locations = Location::all();
        $subjects = Subject::all();
        $educations = Education::all();
        return view('admin.teacher.create', compact('locations', 'subjects', 'educations'));
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'country_code' => 'required|string|max:100',
            'number' => 'required|string|max:100',
            'headline' => 'nullable|string|max:255',
            'gender' => 'nullable|in:Male,Female,Other',
            'birth_date' => 'nullable|date',
            'location_id' => 'nullable|exists:locations,id',

            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'subjects' => 'required|array|min:1',
            'subjects.*.id' => 'required|exists:subjects,id',
            'subjects.*.from' => 'required|string|max:100',
            'subjects.*.to' => 'required|string|max:100',

            'edu' => 'required|array|min:1',
            'edu.*.edu' => 'required|exists:education,id',
            'edu.*.institution' => 'required|string|max:255',
            'edu.*.start' => 'required|digits:4|integer|min:1950|max:' . date('Y'),
            'edu.*.end' => 'required|digits:4|integer|gte:edu.*.start|max:' . (date('Y') + 5),

            'charge_period' => 'required|in:hourly,daily,weekly,monthly',
            'min_price' => 'required|numeric|min:0',
            'max_price' => 'required|numeric|gte:min_price',
            'years_teaching' => 'nullable|integer|min:0|max:80',
            'years_online' => 'nullable|integer|min:0|max:80',

            'willing_to_travel' => 'nullable',
            'travel_km' => 'nullable|required_if:willing_to_travel,on|integer|min:1|max:1000',
            'has_digital_pen' => 'nullable',
            'helps_homework' => 'nullable',

            'opportunity' => 'nullable|in:full_time,part_time,both',
            'profile_description' => 'nullable|string|max:2000',
        ]);


        // ================= PROFILE IMAGE =================
        $imagePath = null;
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('profile_pictures'), $filename);
            $imagePath = 'profile_pictures/' . $filename;
        }

        // ================= CREATE TEACHER PROFILE =================
        $teacher = TeacherProfile::create([
            'user_id' => Auth::id(), // or admin-selected user
            'profile_picture' => $imagePath,
            'full_name' => $request->full_name,
            'headline' => $request->headline,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'address' => $request->address,
            'location_id' => $request->location_id,
            'charge_period' => $request->charge_period,
            'min_price' => $request->min_price,
            'max_price' => $request->max_price,
            'years_teaching' => $request->years_teaching,
            'years_online' => $request->years_online,
            'willing_to_travel' => $request->has('willing_to_travel'),
            'travel_km' => $request->travel_km,
            'has_digital_pen' => $request->has('has_digital_pen'),
            'helps_homework' => $request->has('helps_homework'),
            'opportunity' => $request->opportunity,
            'profile_description' => $request->profile_description,
        ]);

        // ================= ATTACH SUBJECTS (WITH LEVELS) =================
        foreach ($request->subjects as $subject) {
            $teacher->subjects()->attach($subject['id'], [
                'from_level' => $subject['from'],
                'to_level' => $subject['to'],
            ]);
        }

        // ================= ATTACH EDUCATIONS =================
        foreach ($request->edu as $edu) {
            $teacher->educations()->attach($edu['edu'], [
                'institution' => $edu['institution'],
                'year_completed' => $edu['start'] . 'to' . $edu['end'],

            ]);
        }

        // ================= ATTACH PHONE NUMBERS =================

        $teacher->phones()->create([
            'phone' => $request->number,
            'country_code' => $request->country_code ?? '',
            'is_primary' => 1,
        ]);





        return redirect()
            ->route('admin.teacher.index')
            ->with('success', 'Teacher profile created successfully!');
    }

    public function edit(TeacherProfile $teacher)
    {
        $locations = Location::all();
        $subjects = Subject::all();
        $educations = Education::all();

        $countryCodes = [
            '+1' => 'United States',
            '+44' => 'United Kingdom',
            '+91' => 'India',
            '+61' => 'Australia',
            '+49' => 'Germany',
            '+33' => 'France',
            '+81' => 'Japan',
            '+86' => 'China',
            '+7' => 'Russia',
            '+39' => 'Italy',
            '+34' => 'Spain',
            '+55' => 'Brazil',
            '+27' => 'South Africa',
            '+64' => 'New Zealand',
            '+82' => 'South Korea',
            '+65' => 'Singapore',
            '+971' => 'United Arab Emirates',
            '+966' => 'Saudi Arabia',
            '+20' => 'Egypt',
            '+880' => 'Bangladesh',
            '+92' => 'Pakistan',
            '+234' => 'Nigeria',
        ];

        return view('admin.teacher.edit', compact('teacher', 'locations', 'subjects', 'educations', 'countryCodes'));
    }


    public function update(Request $request, TeacherProfile $teacher)
    {
        // dd($request->all());


        // PROFILE IMAGE
        $imagepath = $teacher->profile_picture;
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('profile_pictures'), $filename);
            $imagepath = 'profile_pictures/' . $filename;
        }
        // dd($teacher->profile_image);

        $teacher->update([
            'profile_picture' => $imagepath,
            'full_name' => $request->full_name,
            'headline' => $request->headline,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'location_id' => $request->location_id,
            'charge_period' => $request->charge_period,
            'min_price' => $request->min_price,
            'max_price' => $request->max_price,
            'years_teaching' => $request->years_teaching,
            'years_online' => $request->years_online,
            'willing_to_travel' => $request->has('willing_to_travel'),
            'travel_km' => $request->travel_km,
            'has_digital_pen' => $request->has('has_digital_pen'),
            'helps_homework' => $request->has('helps_homework'),
            'opportunity' => $request->opportunity,
            'profile_description' => $request->profile_description,
        ]);

        // SUBJECTS
        foreach ($request->subjects as $subject) {
            $teacher->subjects()->updateOrCreate(
                [
                    'teacher_profile_id' => $teacher->id,
                    'subject_id' => $subject['id'],
                ],
                [
                    'from_level' => $subject['from'],
                    'to_level' => $subject['to'],
                ]
            );
        }

        // EDUCATIONS
        // $teacher->educations()->detach();
        foreach ($request->edu as $edu) {
            $teacher->educations()->updateOrCreate(
                [
                    'teacher_profile_id' => $teacher->id,
                    'education_id' => $edu['edu'],
                ],
                [
                    'institution' => $edu['institution'],
                    'year_completed' => $edu['start'] . 'to' . $edu['end'],
                ]
            );
        }

        // PHONE
        $phone = $teacher->phones->first();
        if ($phone) {
            $phone->update([
                'phone' => $request->number,
                'country_code' => $request->country_code,
            ]);
        } else {
            $teacher->phones()->create([
                'phone' => $request->number,
                'country_code' => $request->country_code,
                'is_primary' => 1,
            ]);
        }

        return redirect()
            ->route('admin.teacher.index')
            ->with('success', 'Teacher profile updated successfully!');
    }

    public function destroy(TeacherProfile $teacher)
    {
        $teacher->delete();
        return redirect()
            ->route('admin.teacher.index')
            ->with('success', 'Teacher profile deleted successfully!');
    }

    
}
