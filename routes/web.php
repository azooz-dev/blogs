<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\postController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return;
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     // Route::get('/dashboard', function () {
//     //     return view('');
//     // })->name('dashboard');
// });

Route::get('/post', [postController::class, 'index'])->name('posts.index');
Route::get('/show_post/{post}', [postController::class, 'show'])->name('posts.show');
Route::post('store_posts', [postController::class, 'store'])->name('posts.store');
Route::put('update_posts/{post}', [postController::class, 'update'])->name('posts.update');
Route::delete('delete_posts/{post}', [postController::class, 'destroy'])->name('posts.delete');

Route::post('store_comment', [CommentController::class, 'store'])->name('comments.store');

