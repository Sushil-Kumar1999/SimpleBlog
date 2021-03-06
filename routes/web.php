<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Mail\UserCommented;
use App\Models\Comment;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// Post
Route::get('/posts', [PostController::class, 'index'])->middleware(['auth'])->name('posts.index');

Route::get('/posts/create', [PostController::class, 'create'])->middleware(['auth'])->name('posts.create');

Route::post('/posts', [PostController::class, 'store'])->middleware(['auth'])->name('posts.store');

Route::get('/posts/{post}', [PostController::class, 'show'])->middleware(['auth'])->name('posts.show');

Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->middleware(['auth'])->name('posts.edit');

Route::patch('/posts/{post}', [PostController::class, 'update'])->middleware(['auth'])->name('posts.update');

Route::delete('/posts/{post}', [PostController::class, 'destroy'])->middleware(['auth'])->name('posts.destroy');

// Comment
Route::get('/posts/{post}/comments', [CommentController::class, 'page'])->middleware(['auth'])->name('comments.page');

Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->middleware(['auth'])->name('comments.edit');

Route::patch('/comments/{comment}', [CommentController::class, 'update'])->middleware(['auth'])->name('comments.update');

// Profile
Route::get('/profiles/{profile}', [ProfileController::class, 'show'])->middleware(['auth'])->name('profiles.show');

// Role
Route::get('/roles/{role}', [RoleController::class, 'show'])->middleware(['auth'])->name('roles.show');

// User
Route::get('/users/{user}', [UserController::class, 'show'])->middleware(['auth'])->name('users.show');

// test email markdown template
Route::get('/testemail', function() {
    return new UserCommented(Comment::find(4));
});
