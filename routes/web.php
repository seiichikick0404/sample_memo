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
Route::group(['middleware' => ['auth']], function() {
    Route::get('/memo', [MemoController::class, 'index'])->name('memo.index');
    Route::post('/memo/create_folder', [FolderController::class, 'store'])->name('memo.create_folder');
    Route::get('/memo/select_folder', [FolderController::class, 'select'])->name('memo.select_folder');
    Route::post('/memo/update_folder', [FolderController::class, 'update'])->name('memo.update_folder');
    Route::get('/memo/destroy_folder', [FolderController::class, 'destroy'])->name('memo.destroy_folder');
    Route::get('/memo/select_memo', [MemoController::class, 'select_memo'])->name('memo.select_memo');
    Route::get('/memo/create_memo', [MemoController::class, 'store'])->name('memo.create_memo');
    Route::get('logout', [LoginController::class, 'logout'])->name('memo.logout');
    Route::get('/memo/destroy_memo', [MemoController::class, 'destroy'])->name('memo.destroy_memo');
    Route::post('/memo/update_memo', [MemoController::class, 'update'])->name('memo.update_memo');


});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
