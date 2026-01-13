<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profielset extends Model
{
     protected $fillable = [
        'user_id',
        'iam',
        'name',
        'speciality',
        'gender',
        'birth_date',
        'address',
        'location',
        'phones',
        'subjects',
        'educations',
        'languages',
        'charge_period',
        'min_price',
        'max_price',
        'fee_details',
        'years_teaching',
        'years_online',
        'willing_to_travel',
        'travel_km',
        'has_digital_pen',
        'helps_homework',
        'full_time_employed',
        'opportunity',
        'profile_description',
    ];

    // protected $casts = [
    //     'phones' => 'array',
    //     'subjects' => 'array',
    //     'educations' => 'array',
    //     'languages' => 'array',
    //     'willing_to_travel' => 'boolean',
    //     'has_digital_pen' => 'boolean',
    //     'helps_homework' => 'boolean',
    //     'full_time_employed' => 'boolean',
    // ];

    // ✅ Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
