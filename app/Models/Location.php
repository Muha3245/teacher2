<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'country',
        'state',
        'city',
        'lat',
        'lng'
    ];

    public function teacherProfiles()
    {
        return $this->hasMany(TeacherProfile::class);
    }
}
