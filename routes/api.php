<?php

use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/posts/{post}/comments', [CommentController::class, 'apiStore'])->name('api.comments.store');

Route::get('/posts/{post}/comments', [CommentController::class, 'apiGet'])->name('api.comments.get');

Route::get('/fake/comments', [CommentController::class, 'apiGetFake'])->name('api.comments.getFake');

Route::get('/fake/posts', [CommentController::class, 'apiGetFake'])->name('api.posts.getFake');
