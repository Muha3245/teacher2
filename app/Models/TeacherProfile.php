<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeacherProfile extends Model
{
    use HasFactory;
     protected $fillable = [
        'profile_picture',
        'user_id',
        'headline',
        'full_name',
        'gender',
        'birth_date',
        'address',
        'location_id',
        'charge_period',
        'min_price',
        'max_price',
        'years_teaching',
        'years_online',
        'willing_to_travel',
        'travel_km',
        'has_digital_pen',
        'helps_homework',
        'opportunity',
        'profile_description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function subjects()
    {
        return $this->hasMany(
            TeacherSubjects::class,
            'teacher_profile_id'
        );
    }

    public function educations()
    {
        return $this->hasMany(
            TeacherEducation::class,
            'teacher_profile_id'
        );
    }

    public function phones()
    {
        return $this->hasMany(TeacherPhone::class);
    }
}
