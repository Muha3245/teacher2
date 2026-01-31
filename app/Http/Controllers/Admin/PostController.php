<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentPosts;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts= StudentPosts::with('user')->get();
        return view('admin.post.index',compact('posts'));
    
    }
}
