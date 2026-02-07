<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class StudentPosts extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'location',
        'phone',
        'country_code',
        'description',
        'subjects',
        'levelText',
        'jobType',
        'travel_distance',
        'meeting_tutorplace',
        'budget',
        'budgetType',
        'genderPreference',
        'needSomeone',
        'language',
        'getutorfrom',
        'files',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comments() {
        return $this->hasMany(Comment::class,'post_id','id');
    }

    public function ratings() {
        return $this->hasMany(Rating::class);
    }
}
