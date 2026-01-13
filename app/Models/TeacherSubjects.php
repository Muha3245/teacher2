<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherSubjects extends Model
{
    protected $table = 'teacher_subjects';

    protected $fillable = [
        'teacher_profile_id',
        'subject_id',
        'from_level',
        'to_level',
    ];

    public function teacherProfile()
    {
        return $this->belongsTo(TeacherProfile::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
