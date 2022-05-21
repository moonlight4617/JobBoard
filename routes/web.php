<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\JobController;
use App\Http\Controllers\User\MessageController;
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
Route::get('/jobs/search', [JobController::class, 'query'])->name('jobs.query');
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
Route::get('/jobs/{job}/application', [JobController::class, 'application'])->name('jobs.application');

Route::get('/user/company/{company}', Company::class)->name('company.show');


// 応募済み一覧
Route::get('appliedIndex', [JobController::class, 'appliedIndex'])->middleware(['auth:users', 'ensure.user'])->name('jobs.applied');
Route::post('favorite', [JobController::class, 'favorite'])->middleware('auth:users')->name('posts.ajaxlike');
// お気に入り一覧
Route::get('favorite/index', [JobController::class, 'favoriteIndex'])->middleware(['auth:users', 'ensure.user'])->name('favorite.index');

// メッセージ
Route::get('messages', [MessageController::class, 'index'])->middleware('auth:users')->name('message.index');
Route::post('messages/{company}/post', [MessageController::class, 'post'])->middleware('auth:users')->name('message.post');
Route::get('messages/{company}', [MessageController::class, 'show'])->middleware('auth:users')->name('message.show');

require __DIR__ . '/auth.php';
