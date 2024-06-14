<?php

use App\Http\Controllers\BarController;
use App\Http\Controllers\Errorcontroller;
use App\Http\Controllers\ErrorTestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Article;
use App\Http\Controllers\ArticleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // Take the 3 newest posts
    $latestArticles = Article::orderBy('published_at', 'desc')->take(3)->get();

    return view('welcome', compact('latestArticles'));
})->name('home');

// Resource routes of the base pages. For more info on Resource Routes
Route::resource('/articles', ArticleController::class);
Route::resource('/bars', BarController::class);
Route::resource('/users', UserController::class);
Route::get('/trigger-error', [ErrorTestController::class, 'triggerError']);
Route::resource("/error", Errorcontroller::class);
