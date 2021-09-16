<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard',[HomeController::class,'index'])->name('dashboard');
    Route::get('/my-posts',[PostController::class,'myPosts'])->name('my-posts');
    Route::post('/post/create',[PostController::class,'createPost'])->name('post.create');
    Route::post('/comment/add',[CommentController::class,'addComment'])->name('comment.add');

    Route::get('/my-profile', function () {
        return 'profile render';
    })->name('my-profile');

    Route::get('/friend-list', [FriendController::class, 'list'])->name('friend-list');
    Route::post('friend/request-send',[FriendController::class,'sendRequest'])->name('friend-request-send');
    Route::post('unfriend/request-send',[FriendController::class,'unFriendRequest'])->name('unfriend-request-send');
    Route::post('accept/request-send',[FriendController::class,'acceptRequest'])->name('accept-request-send');
    Route::post('remove/request-send',[FriendController::class,'unFriendRequest'])->name('remove-request-send');
});


require __DIR__.'/auth.php';
