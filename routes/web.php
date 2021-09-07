<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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
    return view('auth.register');
})->middleware(\App\Http\Middleware\isUserLoggedIn::class);

Route::get('/dashboard',[HomeController::class,'index'])->middleware(['auth'])->name('dashboard');

Route::get('/post/create', function () {
    return 'post creation flow';
})->middleware(['auth'])->name('post.create');

Route::get('/my-profile', function () {
    return 'profile render';
})->middleware(['auth'])->name('my-profile');

Route::get('/friend-list', [\App\Http\Controllers\FriendController::class, 'list'])->middleware(['auth'])->name('friend-list');

require __DIR__.'/auth.php';
