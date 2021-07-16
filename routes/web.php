<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
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
    return view('welcome');
});

Route::get('/login',[AuthController::class,'index'])->name('login');
Route::post('authenticate',[AuthController::class,'authenticate'])->name('login.post');

Route::middleware(['auth'])->group(function(){
    Route::get('logout',[AuthController::class,'logout'])->name('logout');
    Route::get('/home',[HomeController::class,'index'])->name('home.index');
    Route::get('/', function () {
        return view('pages.dashboard.admin');
    })->name('/');
    Route::get('roles',[RoleController::class,'index'])->name('roles.index');
    Route::resource('users', UserController::class);
    Route::resource('students', StudentController::class);
    Route::resource('classes', ClassController::class);
    Route::resource('instructors', InstructorController::class);
});


//Language Change
Route::get('lang/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'de', 'es','fr','pt', 'cn', 'ae'])) {
        abort(400);
    }   
    Session()->put('locale', $locale);
    Session::get('locale');
    Application::setLocale(Session::get('locale'));
    $locale = Application::getLocale();
    return redirect()->back();
})->name('lang');



Route::prefix('dashboard')->group(function () {
    Route::view('index', 'back.dashboard.index')->name('index');
});


Route::prefix('color-version')->group(function () {
    Route::view('layout-light', 'back.color-version.layout-light')->name('layout-light');
    Route::view('layout-dark', 'back.color-version.layout-dark')->name('layout-dark');
});

Route::prefix('page-layout')->group(function () {
    Route::view('layout-box', 'back.page-layout.layout-box')->name('layout-box');
    Route::view('layout-rtl', 'back.page-layout.layout-rtl')->name('layout-rtl');
    Route::view('hide-on-scroll', 'back.page-layout.hide-on-scroll')->name('hide-on-scroll');
});

Route::prefix('footers')->group(function () {
    Route::view('footer-light', 'back.footers.footer-light')->name('footer-light');
    Route::view('footer-dark', 'back.footers.footer-dark')->name('footer-dark');
    Route::view('footer-fixed', 'back.footers.footer-fixed')->name('footer-fixed');
});

// Route::prefix('starter-kit')->group(function () {
//     Route::view('layout-light', 'starter-kit.layout-light')->name('layout-light');
//     Route::view('layout-rtl', 'starter-kit.layout-rtl')->name('layout-rtl');
//     Route::view('layout-dark', 'starter-kit.layout-dark')->name('layout-dark');
//     Route::view('dark-rtl-layout', 'starter-kit.dark-rtl-layout')->name('dark-rtl-layout');
//     Route::view('semi-dark-layout', 'starter-kit.semi-dark')->name('semi-dark');
//     Route::view('semi-dark-rtl-layout', 'starter-kit.semi-dark-rtl')->name('semi-dark-rtl');
//     Route::view('compact-layout', 'starter-kit.compact-layout')->name('compact-layout');
//     Route::view('compact-rtl-layout', 'starter-kit.compact-rtl-layout')->name('compact-rtl-layout');
//     Route::view('layout-box', 'starter-kit.layout-box')->name('layout-box');
//     Route::view('vertical-layout', 'starter-kit.vertical-layout')->name('vertical-layout');
//     Route::view('vertical-rtl-layout', 'starter-kit.vertical-rtl-layout')->name('vertical-rtl-layout');
//     Route::view('dark-box-layout', 'starter-kit.dark-box-layout')->name('dark-box-layout');
//     Route::view('vertical-box-layout', 'starter-kit.vertical-box-layout')->name('vertical-box-layout');
//     Route::view('compact-dark-layout', 'starter-kit.compact-dark-layout')->name('compact-dark-layout');
//     Route::view('compact-dark-rtl-layout', 'starter-kit.compact-dark-rtl-layout')->name('compact-dark-rtl-layout');
//     Route::view('hide-on-scroll', 'starter-kit.hide-on-scroll')->name('hide-on-scroll');
//     Route::view('footer-light', 'starter-kit.footer-light')->name('footer-light');
//     Route::view('footer-dark', 'starter-kit.footer-dark')->name('footer-dark');
//     Route::view('footer-fixed', 'starter-kit.footer-fixed')->name('footer-fixed');
// });

Route::prefix('others')->group(function () {
    Route::view('400', 'errors.400')->name('error-400');
    Route::view('401', 'errors.401')->name('error-401');
    Route::view('403', 'errors.403')->name('error-403');
    Route::view('404', 'errors.404')->name('error-404');
    Route::view('500', 'errors.500')->name('error-500');
    Route::view('503', 'errors.503')->name('error-503');
});
