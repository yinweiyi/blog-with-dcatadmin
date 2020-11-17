<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\CommentController;

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

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/category/{id}', [HomeController::class, 'category'])->where('id', '[0-9]+')->name('home.index_category');
Route::get('/tag/{id}', [HomeController::class, 'tag'])->where('id', '[0-9]+')->name('home.index_tag');

Route::get('/about', [HomeController::class, 'about'])->name('home.about');
Route::get('/guest-book', [HomeController::class, 'guestBook'])->name('home.guest_book');

Route::get('/articles/{id}', [ArticleController::class, 'show'])->where('id', '[0-9]+')->name('article.show');

Route::get('/captcha', [CaptchaController::class, 'captcha'])->name('captcha');

Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');


