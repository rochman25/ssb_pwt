<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentPaymentController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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
    return view('pages.landing-page.index');
})->name('index');

Route::get('/index', function () {
    return view('pages.landing-page.index');
})->name('index');

// Auth::routes(['verify' => true]);
Route::get('/login',[AuthController::class,'index'])->name('login');
Route::post('/authenticate',[AuthController::class,'authenticate'])->name('login.post');
Route::get('/register',[AuthController::class, 'register'])->name('register');
Route::post('/register',[AuthController::class,'storeNewUser'])->name('register.post');
Route::get('/register_success',[AuthController::class,'registerDone'])->name('register.success');
Route::get('/verification/{id}/{hash}',[AuthController::class,'verification'])->middleware(['signed','throttle:6,1'])->name('verification.verify');
Route::get('/not_verified',[AuthController::class,'notVerified'])->name('verification.notice');
Route::get('/forgot-password', function () {
    return view('pages.auth.forgot-password');
})->middleware('guest')->name('password.request');
Route::post('/forgot-password',[AuthController::class,'forgotPassword'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', function ($token) {
    return view('pages.auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');
Route::post('/reset-password',[AuthController::class,'resetPassword'])->middleware('guest')->name('password.update');


Route::middleware(['auth','verified'])->group(function(){
    Route::get('logout',[AuthController::class,'logout'])->name('logout');
    Route::get('/home',[HomeController::class,'index'])->name('home.index');
    Route::get('/dashboard', function () {
        return view('pages.dashboard.admin');
    })->name('/');
    Route::get('roles',[RoleController::class,'index'])->name('roles.index');
    Route::resource('users', UserController::class);
    Route::put('students/{id}/biodata',[StudentController::class,'updateStudent'])->name('students.update.biodata');
    Route::get('students/print/all',[StudentController::class,'printStudents'])->name('students.print');
    Route::resource('students', StudentController::class);
    Route::get('classes/print/all',[ClassController::class,'printClasses'])->name('classes.print');
    Route::resource('classes', ClassController::class);
    Route::get('instructors/print/all',[InstructorController::class,'printInstructor'])->name('instructors.print');
    Route::resource('instructors', InstructorController::class);
    Route::get('schedules/{id}/detail/create',[ScheduleController::class,'createDetail'])->name('schedules.detail.create');
    Route::post('schedules/{id}/detail/store',[ScheduleController::class,'storeDetail'])->name('schedules.detail.store');
    Route::get('schedules/{id}/detail/json',[ScheduleController::class,'getDetailScheduleJson'])->name('schedules.detail.json');
    Route::resource('schedules', ScheduleController::class);
    Route::post('student_payments/{id}/student',[StudentPaymentController::class,'storeStudent'])->name('student_payments.store.student');
    Route::get('student_payments/{id}/print',[StudentPaymentController::class,'printPaymentStudent'])->name('student_payments.print');
    Route::resource('student_payments', StudentPaymentController::class);
});


// Route::prefix('dashboard')->group(function () {
//     Route::view('index', 'back.dashboard.index')->name('index');
// });

