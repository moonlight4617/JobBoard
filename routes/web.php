<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\JobController;
use App\Http\Controllers\User\Company;


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
    return view('user.welcome');
});

Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth:users'])->name('dashboard');

Route::resource('user', UserController::class, ['except' => 'index'])->middleware(['auth:users', 'ensure.user']);
Route::post('deletepicture', [UserController::class, 'pictureDestroy'])->middleware('auth:users')->name('picture.delete');
Route::post('addpicture', [UserController::class, 'pictureAdd'])->middleware('auth:users')->name('picture.add');

Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
Route::get('/jobs/{job}/application', [JobController::class, 'application'])->name('jobs.application');

Route::get('/user/company/{company}', Company::class)->name('company.show');




Route::post('favorite', [JobController::class, 'favorite'])->middleware('auth:users')->name('posts.ajaxlike');



require __DIR__ . '/auth.php';
