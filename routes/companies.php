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

// Route::get('/jobs', [JobsController::class, 'index'])->middleware('auth:companies')->name('job.index');
// Route::get('/jobs/create', [JobsController::class, 'create'])->middleware('auth:companies')->name('job.create');
// Route::post('/jobs/store', [JobsController::class, 'store'])->middleware('auth:companies')->name('job.store');
// Route::get('/jobs/{job}', [JobsController::class, 'show'])->middleware('auth:companies')->name('job.show');
// Route::get('/jobs/{job}/edit', [JobsController::class, 'edit'])->middleware('auth:companies')->name('job.edit');
// Route::post('/jobs/{job}/update', [JobsController::class, 'update'])->middleware('auth:companies')->name('job.update');
// Route::post('/jobs/{job}/destroy', [JobsController::class, 'destroy'])->middleware('auth:companies')->name('job.destroy');
Route::resource('jobs', JobsController::class)->middleware('auth:companies');

Route::resource('company', CompanyController::class, ['except' => 'index'])->middleware('auth:companies');
