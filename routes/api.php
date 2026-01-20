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
Route::post('/stepone',[TeacherProfile::class, 'stepone'])->name('step1from');
Route::post('/steptwo',[TeacherProfile::class, 'steptwo'])->name('step2from');
Route::post('/stepthree',[TeacherProfile::class, 'stepthree'])->name('step3from');
// Route::put('/stepthree',[TeacherProfile::class, 'stepthree'])->name('step3from');
Route::post('/stepthree/delete',[TeacherProfile::class, 'deleteSubject'])->name('step3delete');
Route::post('/stepfour',[TeacherProfile::class, 'stepfour'])->name('step4from');
Route::post('stepfour/delete',[TeacherProfile::class, 'deleteEducation'])->name('step4delete');
Route::post('/stepfive',[TeacherProfile::class, 'stepfive'])->name('step5from');
Route::post('/stepfive/delete',[TeacherProfile::class, 'deletePhone'])->name('step5delete');
Route::post('/stepsix',[TeacherProfile::class, 'stepsix'])->name('step6from');

