<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardPostController;

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
    return view('home', [
        'title' => 'Home',
        'active'    => 'home'
    ]);
});

Route::get('/about', function () {
    return view('about', [
        'title' => 'About',
        'active'    => 'about'
    ]);
});



Route::get('/blog', [PostsController::class, 'index']);




// halaman detail blog

// Route::get('blog/{slug}', [PostsController::class, 'detail']);
Route::get('blog/{post:slug}', [PostsController::class, 'detail']);

Route::get('/categories', function () {
    return view('categories', [
        'title' => 'Posts Categories',
        'active'    => 'categories',
        'categories' => Category::all()

    ]);
});


Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'autenticate']);
Route::post('/logout', [LoginController::class, 'logout']);


Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);


Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware('auth');



Route::get('/dashboard/posts/createSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');
