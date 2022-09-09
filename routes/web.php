<?php

use App\Http\Controllers\FacultyController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
    // $role = Role::create(['name' => 'teacher']);
    // $role = Role::create(['name' => 'student']);
    // $user = User::find(1);
    // $role = Role::findById(1);
    // $permission = Permission::all();
    // $role->givePermissionTo($permission);
    // $permission = Permission::create(['name' => 'create']);
    // $permission = Permission::create(['name' => 'view']);
    // $permission = Permission::create(['name' => 'edit']);
    // $permission = Permission::create(['name' => 'delete']);
    // $user->assignRole($role);
    // $user = User::find(2);
    // $subject = Subject::find(2);
    // $user->subjects()->save($subject, ['mark' => 1.5]);
    return view('home');
});

Route::middleware('role:teacher')->group(function () {
    Route::resource('students', StudentController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('faculties', FacultyController::class);
});

Route::middleware('permission:view')->group(function () {
    Route::resource('subjects', SubjectController::class)->only('index');
    Route::resource('faculties', FacultyController::class)->only('index');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/register-subject', [SubjectController::class, 'registerSubject']);
Route::put('/update/avatar/{id}', [StudentController::class, 'updateAvatar']);
Route::get('/alert-subject', [StudentController::class, 'alertSubject'])->name('alert-subject');
