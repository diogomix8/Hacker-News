<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Favorites\FavoriteController;
use App\Http\Controllers\News\NewController;
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

Route::get('/', [NewController::class, 'index'])->name('welcome');

Route::get('/favorites', [FavoriteController::class, 'index'])->name('show-favorites'); 

Route::post('/favorites/new', [FavoriteController::class, 'create'])->name('create-favorites'); 

Route::get('/favorites/delete', [FavoriteController::class, 'delete'])->name('delete-favorites'); 


Auth::routes();
// Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');

// Route::post('login', [LoginController::class, 'login']);

// Route::get('register', [RegisterController::class, 'showRegistrationForm']);

// Route::post('logout', [LoginController::class, 'logout '])->name('logout');

// Route::post('register', [RegisterController::class, 'register'])->name('register');

Route::get('/home', [HomeController::class, 'index'])->name('home');
