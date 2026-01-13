<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = [
        'degree',
        
    ];

    public function teachers()
    {
        return $this->belongsToMany(
            TeacherProfile::class,
            'teacher_educations'
        );
    }
}
