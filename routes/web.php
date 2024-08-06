<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SyllabusController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\EnrollController;
use App\Http\Controllers\DikteiController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('home');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::resource('school', SchoolController::class);
// Route::resource('school.department', DepartmentController::class)->shallow();
// Route::resource('department.course', CourseController::class)->shallow();
// Route::resource('course.syllabus', SyllabusController::class)->shallow();
// Route::resource('syllabus.subject', SubjectController::class)->shallow();
// Route::resource('enroll', EnrollController::class);

Route::controller(DikteiController::class)->group(function(){
    Route::get('/diktei','index');
    Route::get('/diktei/home','home');
    Route::post('/diktei/entry','entry');
    Route::get('/diktei/entry/{diktei}','option');
    Route::post('/diktei/store/','store');

    Route::get('/diktei/deptslotentry','deptslotentry')->middleware(['auth']);
    Route::post('/diktei/deptslotentry','deptslotentrystore');
    Route::post('/diktei/algorithm','algorithm');

    Route::get('/diktei/allotments','allotments')->middleware(['auth']);
    Route::get('/diktei/allotments/{department}','allotments_dept')->middleware(['auth']);

    Route::get('/diktei/{diktei}','show');
    Route::delete('/diktei/{diktei}','destroy');

});

Route::controller(UserController::class)->group(function(){
    Route::get('/login','login')->name('login');
    Route::post('/login','logincheck');
    Route::post('/logout','logout');
});

// require __DIR__.'/auth.php';
// require __DIR__.'/profile.php';