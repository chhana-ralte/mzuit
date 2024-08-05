<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SyllabusController;
use App\Http\Controllers\EnrollController;
use App\Http\Controllers\DikteiController;

Route::get('/', function () {
    return redirect('/diktei');
    return view('diktei.dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('school', SchoolController::class);
Route::resource('school.department', DepartmentController::class)->shallow();
Route::resource('department.course', CourseController::class)->shallow();
Route::resource('course.syllabus', SyllabusController::class)->shallow();
Route::resource('enroll', EnrollController::class);

Route::controller(DikteiController::class)->group(function(){
    Route::get('/diktei','index');
    Route::post('/diktei/entry','entry');
    Route::get('/diktei/entry/{diktei}','option');
    Route::post('/diktei/store/','store');

    Route::get('/diktei/deptslotentry','deptslotentry');
    Route::post('/diktei/deptslotentry','deptslotentrystore');

    Route::get('/diktei/allotments','allotments');
    Route::get('/diktei/allotments/{department}','allotments_dept');

    Route::post('/diktei/algorithm','algorithm');
});

require __DIR__.'/auth.php';
require __DIR__.'/profile.php';