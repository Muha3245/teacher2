<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\TeacherDash\TeacherProfile;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::get('/allprofiles', function(){
//     return TeacherProfile::all();
// });

Route::post('/multistep-profile',[TeacherProfile::class, 'store'])->name('apimultistepprofile');