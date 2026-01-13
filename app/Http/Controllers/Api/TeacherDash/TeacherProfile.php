<?php

namespace App\Http\Controllers\Api\TeacherDash;

use App\Http\Controllers\Controller;
use App\Models\TeacherProfile as Tprofile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
