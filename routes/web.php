<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SyllabusController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SubjectcontentController;
use App\Http\Controllers\EnrollController;
use App\Http\Controllers\EnrollSubjectController;
use App\Http\Controllers\SessnController;
use App\Http\Controllers\SubjectTeacherController;
use App\Http\Controllers\MassController;
use App\Http\Controllers\DikteiController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('home');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('school', SchoolController::class)->middleware('auth');
Route::resource('school.department', DepartmentController::class)->shallow()->middleware('auth');
Route::resource('department.course', CourseController::class)->shallow()->middleware('auth');
Route::resource('course.syllabus', SyllabusController::class)->shallow()->middleware('auth');
Route::resource('department.teacher', TeacherController::class)->shallow()->middleware('auth');
Route::resource('syllabus.subject', SubjectController::class)->shallow()->middleware('auth');
Route::resource('subject.subjectcontent', SubjectcontentController::class)->shallow()->middleware('auth');
Route::resource('enroll', EnrollController::class)->middleware('auth');
Route::resource('sessn', SessnController::class)->middleware('auth');
Route::get('/role/{role}', function(App\Models\Role $role){
    return ['role'=>$role->role, 'checked'=>$_GET['checked']];
});
//Route::resource('enroll_subject', EnrollSubjectController::class);
//Route::resource('sessn.subject_teacher', SubjectTeacherController::class)->shallow();

Route::controller(EnrollSubjectController::class)->group(function(){
    Route::get('/enroll_subject','index')->name('enroll_subject.index'); //List of subjects in semester, course, session
    Route::get('/enroll_subject/{enroll}','show')->name('enroll_subject.show'); //list of subjects for enrollment
    Route::post('/enroll_subject/{enroll}','store')->middleware('auth'); // Addition of subject to enrollment
    Route::get('/enroll_subject/{enroll}/create','create')->middleware('auth'); // 
    Route::delete('/enroll_subject/{enroll}','destroy')->middleware('auth'); // removal of subject from enrollment
});

Route::controller(SubjectTeacherController::class)->group(function(){
    Route::get('/subject_teacher/searchresults','searchResults');
    Route::get('/subject_teacher/{subject}/{sessn}','index')->middleware('auth');
    Route::get('/subject_teacher/{subject}/{sessn}/create','create')->middleware('auth');
    Route::post('/subject_teacher/{subject}/{sessn}','store')->middleware('auth');
    Route::delete('/subject_teacher/{subject_teacher}','destroy')->middleware('auth');
});

Route::controller(MassController::class)->group(function(){
    Route::get('/mass/enrollsubject','enrollSubject')->middleware('auth');
    Route::post('/mass/enrollsubject','enrollSubjectStore')->middleware('auth');
    Route::get('/mass/promote','promote')->middleware('auth');
    Route::post('/mass/promote','promoteStore')->middleware('auth');
});

Route::controller(DikteiController::class)->group(function(){
    Route::get('/diktei','index');
    Route::get('/diktei/home','home')->middleware(['auth']);
    Route::post('/diktei/entry','entry');
    Route::get('/diktei/entry/{diktei}','option');
    Route::post('/diktei/store/','store');
    Route::get('/diktei/search/','search');

    Route::get('/diktei/deptslotentry','deptslotentry')->middleware(['auth']);
    Route::post('/diktei/deptslotentry','deptslotentrystore');
    Route::post('/diktei/algorithm','algorithm');

    Route::get('/diktei/allotments','allotments')->middleware(['auth']);
    Route::get('/diktei/unallotted','unallotted')->middleware(['auth']);
    Route::get('/diktei/allotments/{department}','allotments_dept')->middleware(['auth']);

    Route::get('/diktei/{diktei}','show')->middleware(['auth']);
    Route::post('/diktei/{diktei}/assigndept','assigndept')->middleware('auth');
    Route::post('/diktei/{diktei}/clear','clear')->middleware('auth');
    Route::delete('/diktei/{diktei}','destroy')->middleware('auth');

});

Route::controller(UserController::class)->group(function(){
    Route::get('/user','index')->middleware(['auth']);
    Route::get('/user/changePassword','changePassword')->middleware(['auth']);
    Route::post('/user/changePassword','changePasswordStore')->middleware(['auth']);
    Route::get('/user/create','create')->middleware(['auth']);
    Route::post('/user','store')->middleware(['auth']);
    Route::get('/user/{user}','show')->middleware(['auth']);
    Route::get('/user/{user}/edit','edit')->middleware(['auth']);
    Route::patch('/user/{user}','update')->middleware(['auth']);

    Route::delete('/user/{user}','destroy')->middleware(['auth']);
    Route::get('/login','login')->name('login');
    Route::post('/login','logincheck');
    Route::post('/logout','logout');
});

// require __DIR__.'/auth.php';
// require __DIR__.'/profile.php';