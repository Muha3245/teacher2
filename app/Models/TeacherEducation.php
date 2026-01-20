<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeacherEducation extends Model
{
    use HasFactory;
    protected $table = 'teacher_educations';

    protected $fillable = [
        'teacher_profile_id',
        'education_id',
        'field',
        'institution',
        'start_year',
        'end_year',
    ];

    public function teacherProfile()
    {
        return $this->belongsTo(TeacherProfile::class);
    }

    public function education()
    {
        return $this->belongsTo(Education::class);
    }
}
