<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemoController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


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



Route::get('/', [LoginController::class, 'showLoginForm'])->name('login.index');
Route::get('/user', [RegisterController::class, 'showRegistrationForm'])->name('register.index');
Route::group(['middleware' => ['auth'], 'prefix' => 'memo', 'as' => 'memo.'], function() {
    Route::get('', [MemoController::class, 'index'])->name('index');
    Route::post('/create_folder', [FolderController::class, 'store'])->name('create_folder');
    Route::get('/select_folder', [FolderController::class, 'select'])->name('select_folder');
    Route::get('/select_all_folder', [FolderController::class, 'select_all_folder'])->name('select_all_folder');
    Route::post('/update_folder', [FolderController::class, 'update'])->name('update_folder');
    Route::get('/destroy_folder', [FolderController::class, 'destroy'])->name('destroy_folder');
    Route::get('/select_memo', [MemoController::class, 'select_memo'])->name('select_memo');
    Route::get('/create_memo', [MemoController::class, 'store'])->name('create_memo');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/destroy_memo', [MemoController::class, 'destroy'])->name('destroy_memo');
    Route::post('/update_memo', [MemoController::class, 'update'])->name('update_memo');
    Route::get('/memo_search_memo', [MemoController::class, 'search'])->name('search_memo');
    Route::get('/memo_lock', [MemoController::class , 'memo_lock'])->name('lock');
    Route::get('/memo_lock_close', [MemoController::class , 'memo_lock_close'])->name('lock_close');
    Route::get('/memo_lock_destroy', [MemoController::class, 'memo_lock_destroy'])->name('lock_destroy');
    Route::post('/lock_release', [MemoController::class, 'memo_lock_release'])->name('lock_release');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
