<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'post_id',
        'user_id',
        'content',
        'seen_at'
    ];

    public function post()
    {
        return $this->belongsTo(StudentPosts::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies() {
        return $this->hasMany(Reply::class, 'comment_id','id');
    }

    public function ratings() {
        return $this->hasMany(Rating::class, 'post_id','id');
    }
}
