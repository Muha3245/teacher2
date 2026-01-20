<?php

namespace App\Http\Controllers\Api\TeacherDash;

use App\Models\Subject;
use App\Models\Location;
use App\Models\Education;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\TeacherProfile as Tprofile;
use App\Models\TeacherSubjects as Tsubject;
use App\Models\TeacherPhone;


class TeacherProfile extends Controller
{
    public function store(Request $request)
    {
        /* ===============================
           Decode JSON steps (IMPORTANT)
        =============================== */
        $step1 = json_decode($request->step1 ?? '{}', true);
        $step2 = json_decode($request->step2 ?? '{}', true);
        $step3 = json_decode($request->step3 ?? '{}', true);
        $step4 = json_decode($request->step4 ?? '{}', true);
        $step5 = json_decode($request->step5 ?? '{}', true);

        /* ===============================
           Handle Profile Picture
        =============================== */
        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('profile_pictures'), $name);
            $profilePicturePath = 'profile_pictures/' . $name;
        }

        /* ===============================
           Create Teacher Profile
        =============================== */
        $profile = Tprofile::create([
            'user_id'             => $request->user_id,
            'profile_picture'     => $profilePicturePath,
            'full_name'           => $step1['full_name'] ?? null,
            'gender'              => $step1['gender'] ?? null,
            'birth_date'          => $step1['birth_date'] ?? null,
            'address'             => $step1['address'] ?? null,
            'location_id'         => $step1['location_id'] ?? null,

            'headline'            => $step2['headline'] ?? null,
            'charge_period'       => $step2['charge_period'] ?? null,
            'min_price'           => $step2['min_price'] ?? null,
            'max_price'           => $step2['max_price'] ?? null,
            'years_teaching'      => $step2['years_teaching'] ?? null,
            'years_online'        => $step2['years_online'] ?? null,
            'travel_km'           => $step2['travel_km'] ?? null,

            'opportunity'         => $step5['opportunity'] ?? null,
            'profile_description' => $step5['profile_description'] ?? null,
        ]);

        /* ===============================
           Save Subjects
        =============================== */
        if (!empty($step3['subjects'])) {
            $profile->subjects()->createMany(
                collect($step3['subjects'])->map(fn($s) => [
                    'subject_id' => $s['subject_id'],
                    'from_level' => $s['from_level'],
                    'to_level'   => $s['to_level'],
                    'teacher_profile_id' => $profile->id,
                ])->toArray()
            );
        }

        /* ===============================
           Save Educations
        =============================== */
        if (!empty($step4['educations'])) {
            $profile->educations()->createMany(
                collect($step4['educations'])->map(fn($e) => [
                    'education_id'   => $e['education_id'] ?? null,
                    'field'          => $e['field'],
                    'institution'    => $e['institution'],
                    'year_completed' => $e['year_completed'],
                    'teacher_profile_id' => $profile->id,
                ])->toArray()
            );
        }

        return response()->json([
            'status' => true,
            'message' => 'Teacher profile created successfully',
            'profile_id' => $profile->id,
        ]);
    }

    public function stepone(Request $request)
    {

        $userid = $request->user_id;
        $profile = Tprofile::where('user_id', $userid)->first();

        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('profile_pictures'), $name);
            $profilePicturePath = 'profile_pictures/' . $name;
        }
        $profile = Tprofile::updateOrCreate(
            ['user_id' => $userid],
            [
                'profile_picture' => $profilePicturePath ?? $profile->profile_picture,
                'full_name' => $request->full_name,
                'gender' => $request->gender,
                'birth_date' => $request->birth_date,
                'location' => $request->location,
                'address' => $request->address,
                'user_id' => $request->user_id,
            ]
        );


        return response()->json([
            'status' => true,
            'message' => 'Teacher profile created successfully',
            'profile' => $profile,
        ]);
    }

    public function steptwo(Request $request)
    {
        $userId = $request->user_id;

        $profile = Tprofile::updateOrCreate(
            ['user_id' => $userId],
            [
                'headline' => $request->headline,
                'charge_period' => $request->charge_period,
                'min_price' => $request->min_price,
                'max_price' => $request->max_price,
                'years_teaching' => $request->years_teaching,
                'years_online' => $request->years_online,
                'willing_to_travel' => $request->has('willing_to_travel'),
                'travel_km' => $request->travel_km,
                'has_digital_pen' => $request->has('has_digital_pen'),
                'helps_homework' => $request->has('helps_homework'),
            ]
        );

        return response()->json([
            'status' => true,
            'message' => 'Step 2 saved successfully',
            'profile' => $profile,
        ]);
    }

    public function stepthree(Request $request)
    {
        Log::info('step 3', $request->all());


        $profile = Tprofile::where('user_id', $request->user_id)->firstOrFail();

        // Create or fetch subject
        if (is_numeric($request->subject_id)) {
            $subject = Subject::findOrFail($request->subject_id);
        } else {
            $subject = Subject::firstOrCreate([
                'name' => trim($request->subject_id)
            ]);
        }

        if ($request->edit && $request->subject_profile_id) {
            // Update existing
            $subjectProfile = $profile->subjects()->find($request->subject_profile_id);
            if ($subjectProfile) {
                $subjectProfile->update([
                    'subject_id' => $subject->id,
                    'from_level' => $request->from_level,
                    'to_level' => $request->to_level,
                ]);
            }
        } else {
            // Create new
            $subjectProfile = $profile->subjects()->create([
                'subject_id' => $subject->id,
                'from_level' => $request->from_level,
                'to_level' => $request->to_level,
                'teacher_profile_id' => $profile->id,
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => $request->edit ? 'Subject updated successfully' : 'Subject added successfully',
            'subject_name' => $subject->name,
            'from_level' => $subjectProfile->from_level,
            'to_level' => $subjectProfile->to_level,
            'subject_profile_id' => $subjectProfile->id,
        ]);
    }

    // Delete API
    public function deleteSubject(Request $request)
    {
        Log::info('step 3', $request->all());
        $subjectProfile = Tsubject::findOrFail($request->subject_profile_id);
        $subjectProfile->delete();
        return response()->json(['status' => true, 'message' => 'Subject deleted successfully']);
    }

    public function stepfour(Request $request)
    {
        Log::info('step 4', $request->all());
        $profile = Tprofile::where('user_id', $request->user_id)->firstOrFail();

        // Create or fetch subject
        if (is_numeric($request->education_id)) {
            $education = Education::findOrFail($request->education_id);
        } else {
            $education = Education::firstOrCreate([
                'degree' => trim($request->education_id)
            ]);
        }

        if ($request->edit && $request->education_profile_id) {
            // Update existing
            $educationProfile = $profile->educations()->find($request->education_profile_id);
            if ($educationProfile) {
                $educationProfile->update([
                    'education_id' => $education->id,
                    'field' => $request->field,
                    'institution' => $request->institution,
                    'start_year' => $request->start_year,
                    'end_year' => $request->end_year,
                ]);
            }
        } else {
            // Create new
            $educationProfile = $profile->educations()->create([
                'education_id' => $education->id,
                'field' => $request->field,
                'institution' => $request->institution,
                'start_year' => $request->start_year,
                'end_year' => $request->end_year,
                'teacher_profile_id' => $profile->id,
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => $request->edit ? 'education updated successfully' : 'education added successfully',
            'education_name' => $education->degree,
            'field' => $educationProfile->field,
            'institution' => $educationProfile->institution,
            'start_year' => $educationProfile->start_year,
            'end_year' => $educationProfile->end_year,
            'education_profile_id' => $educationProfile->id,
            'education_id' => $educationProfile->education_id,
        ]);
    }
    public function deleteEducation(Request $request)
    {
        $education = Education::find($request->education_profile_id);
        if ($education) {
            $education->delete();
        }
        return response()->json(['status' => true, 'message' => 'Education deleted successfully']);
    }

    public function stepfive(Request $request)
    {
        Log::info('step 5', $request->all());
        $profile = Tprofile::where('user_id', $request->user_id)->firstOrFail();

        if ($request->edit && $request->phone_id) {
            $phone = $profile->phones()->find($request->phone_id);
            if ($phone) {
                $phone->update([
                    'phone' => $request->phone_number,
                    'country_code' => $request->country_code,
                    'teacher_profile_id' => $profile->id,
                ]);
            }
        } else {
            $phone = $profile->phones()->create([
                'phone' => $request->phone_number,
                'country_code' => $request->country_code,
                'teacher_profile_id' => $profile->id,
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => $request->edit ? 'Phone updated successfully' : 'Phone added successfully',
            'phone_number' => $phone->phone,
            'country_code' => $phone->country_code,
            'phone_id' => $phone->id,
        ]);
    }

    public function deletePhone(Request $request)
    {
        Log::info('step 5 delete', $request->all());
        $phone = TeacherPhone::find($request->phone_id);
        if ($phone) {
            $phone->delete();
        }
        return response()->json(['status' => true, 'message' => 'Phone deleted successfully']);
    }


    public function stepsix(Request $request)
    {
        Log::info('step 6', $request->all());
        $profile = Tprofile::where('user_id', $request->user_id)->firstOrFail();

        $profile->update([
            'opportunity' => $request->opportunity,
            'profile_description' => $request->profile_description,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Step 6 saved successfully',
            'profile' => $profile,
        ]);

    }
}
