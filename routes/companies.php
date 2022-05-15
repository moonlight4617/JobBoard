<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Companies\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Companies\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Companies\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Companies\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Companies\Auth\NewPasswordController;
use App\Http\Controllers\Companies\Auth\PasswordResetLinkController;
use App\Http\Controllers\Companies\Auth\RegisteredUserController;
use App\Http\Controllers\Companies\Auth\VerifyEmailController;
use App\Http\Controllers\Companies\JobsController;
use App\Http\Controllers\Companies\CompanyController;
use App\Http\Controllers\Companies\JobSeeker;

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

// Route::get('/', function () {
//   return view('company.welcome');
// });

Route::get('/', function () {
  return view('company.dashboard');
})->middleware('auth:companies')->name('dashboard');

Route::get('/register', [RegisteredUserController::class, 'create'])
  ->middleware('guest')
  ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
  ->middleware('guest');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
  ->middleware('guest')
  ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
  ->middleware('guest');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
  ->middleware('guest')
  ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
  ->middleware('guest')
  ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
  ->middleware('guest')
  ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
  ->middleware('guest')
  ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
  ->middleware('auth:companies')
  ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
  ->middleware(['auth:companies', 'signed', 'throttle:6,1'])
  ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
  ->middleware(['auth:companies', 'throttle:6,1'])
  ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
  ->middleware('auth:companies')
  ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
  ->middleware('auth:companies');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
  ->middleware('auth:companies')
  ->name('logout');

Route::get('/jobs', [JobsController::class, 'index'])->middleware('auth:companies')->name('jobs.index');
Route::get('/jobs/create', [JobsController::class, 'create'])->middleware('auth:companies')->name('jobs.create');
Route::post('/jobs', [JobsController::class, 'store'])->middleware('auth:companies')->name('jobs.store');
Route::get('/jobs/{job}', [JobsController::class, 'show'])->middleware(['ensure.jobCompany', 'auth:companies'])->name('jobs.show');
Route::get('/jobs/{job}/edit', [JobsController::class, 'edit'])->middleware(['ensure.jobCompany', 'auth:companies'])->name('jobs.edit');
Route::put('/jobs/{job}', [JobsController::class, 'update'])->middleware(['ensure.jobCompany', 'auth:companies'])->name('jobs.update');
Route::delete('/jobs/{job}', [JobsController::class, 'destroy'])->middleware(['ensure.jobCompany', 'auth:companies'])->name('jobs.destroy');
// Route::resource('jobs', JobsController::class)->middleware('auth:companies');

Route::resource('company', CompanyController::class, ['except' => 'index'])->middleware(['ensure.company', 'auth:companies']);

// 人材
Route::get('/hresource', [JobSeeker::class, 'index'])->middleware('auth:companies')->name('user.index');
Route::get('/hresource/followIndex', [JobSeeker::class, 'followIndex'])->middleware('auth:companies')->name('user.followIndex');
Route::get('/hresource/search', [JobSeeker::class, 'search'])->middleware('auth:companies')->name('user.index.search');
Route::get('/hresource/followSearch', [JobSeeker::class, 'followSearch'])->middleware('auth:companies')->name('user.followIndex.search');

// フォロー機能
Route::post('/hresource/follow', [JobSeeker::class, 'follow'])->middleware('auth:companies')->name('user.follow');

// ユーザーとしてログイン
Route::get('/loginToUser', [AuthenticatedSessionController::class, 'loginToUser'])
  ->middleware('auth:companies')
  ->name('loginToUser');
