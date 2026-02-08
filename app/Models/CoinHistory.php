<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoinHistory extends Model
{
    protected $fillable = [
        'user_id',
        'student_post_id',
        'coins',
        'type',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function studentPost()
    {
        return $this->belongsTo(StudentPosts::class,'student_post_id');
    }
}
