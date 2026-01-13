<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeacherPhone extends Model
{
    use HasFactory;
     protected $fillable = [
        'teacher_profile_id',
        'phone',
        'country_code',
        'is_primary'
    ];

    public function teacherProfile()
    {
        return $this->belongsTo(TeacherProfile::class);
    }
}
