<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name'];

    public function teachers()
    {
        return $this->belongsToMany(
            TeacherProfile::class,
            'teacher_subjects'
        );
    }
}
