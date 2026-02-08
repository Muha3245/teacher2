<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    protected $fillable = [
        'teacher_id',
        'student_post_id',
        'body',
        'status'
    ];

    public function teacher()
    {
        return $this->belongsTo(TeacherProfile::class);
    }

    public function studentPost()
    {
        return $this->belongsTo(StudentPosts::class);
    }
}
