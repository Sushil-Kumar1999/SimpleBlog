<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;

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

Route::get('/posts', [PostController::class, 'index'])->middleware(['auth'])->name('posts.index');

Route::get('/posts/create', [PostController::class, 'create'])->middleware(['auth'])->name('posts.create');

Route::post('/posts', [PostController::class, 'store'])->middleware(['auth'])->name('posts.store');

Route::get('/posts/{post}', [PostController::class, 'show'])->middleware(['auth'])->name('posts.show');

Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->middleware(['auth'])->name('posts.edit');

Route::patch('/posts/{post}', [PostController::class, 'update'])->middleware(['auth'])->name('posts.update');

Route::get('/posts/{post}/comments', [CommentController::class, 'page'])->middleware(['auth'])->name('comments.page');

Route::get('/profiles/{profile}', [ProfileController::class, 'show'])->middleware(['auth'])->name('profiles.show');

Route::get('/roles/{role}', [RoleController::class, 'show'])->middleware(['auth'])->name('roles.show');
