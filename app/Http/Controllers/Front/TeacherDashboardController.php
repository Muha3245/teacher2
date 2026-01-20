<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\TeacherProfile;
use App\Models\TeacherSubjects;
use App\Models\TeacherEducation;
use App\Models\Location;
use App\Models\Subject;
use App\Models\Education;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class TeacherDashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return view('pages.teacherdash.dashboard')
                ->renderSections()['content'];
        }
        return view('pages.teacherdash.dashboard');
    }
    public function ProfileDetails(Request $request)
    {
        $profile = TeacherProfile::with('user', 'subjects', 'location', 'educations', 'phones')->where('user_id', auth()->id())->firstOrFail();
        $locations = Location::all();
        $subjects = Subject::all();
        $educations = Education::all();

        // dd($profile);

        if ($request->ajax()) {
            // Return ONLY the inner content, no layout
            return view('pages.teacherdash.ProfileDetails', compact('profile', 'locations', 'subjects', 'educations',))
                ->renderSections()['content'];
        }
        return view('pages.teacherdash.ProfileDetails', compact('profile', 'locations', 'subjects', 'educations',));
    }


    protected function profile()
    {
        return TeacherProfile::where('user_id', auth()->id())->firstOrFail();
    }


    public function updateInfo(Request $request)
    {
        $request->validate([
            'full_name' => 'nullable|string',
            'headline' => 'nullable|string',
            'gender' => 'nullable',
            'years_teaching' => 'nullable|integer',
        ]);

        $this->profile()->update($request->only([
            'full_name',
            'headline',
            'gender',
            'years_teaching'
        ]));

        return response()->json([
            'status' => 'success',
            'message' => 'Personal info updated'
        ]);
    }

    public function updatePreferences(Request $request)
    {
        $this->profile()->update([
            'willing_to_travel' => $request->boolean('willing_to_travel'),
            'travel_km' => $request->travel_km,
            'has_digital_pen' => $request->boolean('has_digital_pen'),
            'helps_homework' => $request->boolean('helps_homework'),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Preferences updated'
        ]);
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|max:2048'
        ]);

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $name = now()->timestamp . '_' . $file->getClientOriginalName();
            $file->move(public_path('profile_pictures'), $name);

            $this->profile()->update([
                'profile_picture' => 'profile_pictures/' . $name
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Profile photo updated'
        ]);
    }

    public function updateSubjects(Request $request)
    {
        $profile = $this->profile();

        if ($request->has('subjects')) {
            foreach ($request->subjects as $key => $subjectData) {
                if (is_numeric($key)) {
                    $subject = TeacherSubjects::where('id', $key)
                        ->where('teacher_profile_id', $profile->id)
                        ->first();

                    if ($subject) {
                        $subject->update([
                            'from_level' => $subjectData['from_level'],
                            'to_level' => $subjectData['to_level'],
                        ]);
                    }
                } elseif ($key === 'new' && !empty($subjectData['subject_name'])) {
                    $sub = Subject::firstOrCreate(['name' => $subjectData['subject_name']]);

                    TeacherSubjects::create([
                        'teacher_profile_id' => $profile->id,
                        'subject_id' => $sub->id,
                        'from_level' => $subjectData['from_level'],
                        'to_level' => $subjectData['to_level'],
                    ]);
                }
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Subjects updated'
        ]);
    }

    public function updateEducations(Request $request)
    {
        Log::info('updateEducations', $request->all());

        $profile = $this->profile();

        if (!$request->has('educations')) {
            return response()->json([
                'status' => false,
                'message' => 'No education data received'
            ], 422);
        }

        foreach ($request->educations as $key => $eduData) {

            /**
             * ======================
             * UPDATE EXISTING
             * ======================
             */
            if (is_numeric($key)) {

                $education = TeacherEducation::where('id', $key)
                    ->where('teacher_profile_id', $profile->id)
                    ->first();

                if ($education) {
                    $education->update([
                        'education_id' => $eduData['degree_name'], // ID
                        'institution'  => $eduData['institution'],
                        'field'        => $eduData['field'] ?? null,
                        'start_year'   => $eduData['start_year'],
                        'end_year'     => $eduData['end_year'],
                    ]);
                }
            }

            /**
             * ======================
             * ADD NEW
             * ======================
             */
            if ($key === 'new' && !empty($eduData['degree_name'])) {

                // If select2 tag → string, else → ID
                if (is_numeric($eduData['degree_name'])) {
                    $educationId = $eduData['degree_name'];
                } else {
                    $education = Education::firstOrCreate([
                        'degree' => $eduData['degree_name']
                    ]);
                    $educationId = $education->id;
                }

                TeacherEducation::create([
                    'teacher_profile_id' => $profile->id,
                    'education_id'       => $educationId,
                    'institution'        => $eduData['institution'],
                    'field'              => $eduData['field'] ?? null,
                    'start_year'         => $eduData['start_year'],
                    'end_year'           => $eduData['end_year'],
                ]);
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Education saved successfully'
        ]);
    }

    public function updatePhone(Request $request)
    {
        $profile = $this->profile();

        // Check if phones array exists
        if ($request->has('phones')) {
            foreach ($request->phones as $phoneId => $phoneData) {

                // Find the phone record for this profile
                $phone = $profile->phones()->where('id', $phoneId)->first();

                if ($phone) {
                    // Update existing phone
                    $phone->update([
                        'phone' => $phoneData['number'] ?? null,
                        'country_code' => $phoneData['code'] ?? null,
                    ]);
                }
            }
        }
        // Update charge period and prices
        $profile->update([
            'charge_period' => $request->charge_period,
            'min_price' => $request->min_price,
            'max_price' => $request->max_price,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Phone numbers updated successfully',
        ]);
    }
}
