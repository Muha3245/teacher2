<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TeacherController;
use App\Models\TeacherProfile;
use App\Http\Controllers\Front\AuthController;
use Illuminate\Http\Request;

use App\Http\Controllers\Front\TeacherDashboardController;





Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/admin', function () {
    return view('admin.home');
})->name('admin');


// Admin side
Route::get('/admin/user',[UserController::class, 'index'])->name('admin.user.index');
    //Teacher 
Route::get('/admin/teacher/profile',[TeacherController::class, 'index'])->name('admin.teacher.index');
Route::get('/admin/teacher/create',[TeacherController::class, 'create'])->name('admin.teacher.create');
Route::post('/admin/teacher/store',[TeacherController::class, 'store'])->name('admin.teacher.store');
Route::get('/admin/teacher/{teacher}/edit',[TeacherController::class, 'edit'])->name('admin.teacher.edit');
Route::put('/admin/teacher/{teacher}',[TeacherController::class, 'update'])->name('admin.teacher.update');
Route::delete('/admin/teacher/{teacher}',[TeacherController::class, 'destroy'])->name('admin.teacher.delete');

    



// Frontend side
      // Auth
Route::get('/loginpage',[AuthController::class, 'LoginPage'])->name('loginpage');
Route::get('auth/google',[AuthController::class, 'GoogleLogin'])->name('auth.google');
Route::get('auth/google-callback',[AuthController::class, 'GoogleAuth'])->name('auth.google.callback');
Route::post('auth/register',[AuthController::class,'Register'])->name('auth.register');
Route::post('auth/login',[AuthController::class,'Login'])->name('auth.login');
Route::post('auth/logout',[AuthController::class,'Logout'])->name('auth.logout');


    // Teacherdashboard
Route::get('/teacher/dashboard',[TeacherDashboardController::class, 'index'])->name('teacher.dashboard');
Route::get('/teacher/details' ,[TeacherDashboardController::class, 'ProfileDetails'])->name('teacher.details');
// Route::put('/user/teacher/{teacher}',[TeacherDashboardController::class, 'ProfileUpdate'])->name('user.teacher.update');

Route::middleware(['auth'])->prefix('teacher/profile')->group(function () {

    Route::put('/info', [TeacherDashboardController::class, 'updateInfo'])
        ->name('teacher.profile.info');

    Route::put('/preferences', [TeacherDashboardController::class, 'updatePreferences'])
        ->name('teacher.profile.preferences');

    Route::put('/photo', [TeacherDashboardController::class, 'updatePhoto'])
        ->name('teacher.profile.photo');

    Route::put('/subjects', [TeacherDashboardController::class, 'updateSubjects'])
        ->name('teacher.profile.subjects');

    Route::put('/educations', [TeacherDashboardController::class, 'updateEducations'])
        ->name('teacher.profile.educations');

    Route::put('/phone', [TeacherDashboardController::class, 'updatePhone'])
        ->name('teacher.profile.phone');

        
});

Route::get('/createprofile', function () {
    return view('pages.teacherdash.create-profile');
})->name('createprofile');


Route::post('/profile/create/step/{step}',function(request $request){
    dd($request->all());
})->name('profile.create');


Route::get('/allprofiles', function() {
    return TeacherProfile::all();
});



