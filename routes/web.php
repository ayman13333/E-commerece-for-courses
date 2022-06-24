<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Models\Course;
use App\Models\Video;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth'])->prefix('admin')->group(function(){
    Route::resource('/courses',CourseController::class);
    Route::get('/coursevideos/{id}/coursename/{coursename}',[CourseController::class,'addVideos'])->name('addVideos');
    Route::POST('/insertvideo',[CourseController::class,'insertvideo'])->name('insertvideo');
    Route::POST('/insertvideodata',[CourseController::class,'insertVideoData'])->name('insertVideoData');
    Route::get('/editvideospage/{id}/coursename/{coursename}',[CourseController::class,'editVideosPage'])->name('editVideosPage');
    Route::get('/editvideonamepage/{id}',[CourseController::class,'editVideoNamePage'])->name('editVideoNamePage');
    Route::POST('/editvideoname',[CourseController::class,'editVideoName'])->name('editVideoName');
    Route::POST('/deletevideo',[CourseController::class,'deleteVideo'])->name('deleteVideo');
    Route::get('/confirmdeletecourse/{id}',[CourseController::class,'confirmDeleteCourse'])->name('confirmDeleteCourse');
    Route::get('/bookedcourses',[CourseController::class,'bookedCourses'])->name('bookedCourses');
    Route::get('/opencourse/{id}/courseid/{coursename}',[CourseController::class,'openCourse'])->name('openCourse');
    Route::get('/closecourse/{id}/courseid/{coursename}',[CourseController::class,'closeCourse'])->name('closeCourse');
    Route::get('/deletecourseuser/{id}/courseid/{coursename}',[CourseController::class,'deleteCourseUser'])->name('deleteCourseUser');
    Route::get('/deleteallcoursesuser/{id}',[CourseController::class,'deleteAllCoursesUser'])->name('deleteAllCoursesUser');

});
Route::middleware(['auth'])->prefix('user')->group(function(){
    Route::resource('/comments',CommentController::class);
    Route::resource('/users',UserController::class);
    Route::POST('/deleteuserpost/{id}',[UserController::class,'deleteComment'])->name('deleteComment');
    Route::get('/watchcoursevideos/{id}',[UserController::class,'watchCourseVideos'])->name('watchCourseVideos');
    Route::get('/paidcourses',[UserController::class,'paidCourses'])->name('paidCourses');
    Route::get('/confirmphonepage/{id}/coursename/{coursename}',[UserController::class,'confirmPhonePage'])->name('confirmPhonePage');
    Route::post('/confirmphone',[UserController::class,'confirmPhone'])->name('confirmPhone');
    Route::get('/userbookedcourses',[UserController::class,'userBookedCourses'])->name('userBookedCourses');
    Route::get('/watchpaidcourse/{id}',[UserController::class,'watchPaidCourse'])->name('watchPaidCourse');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
