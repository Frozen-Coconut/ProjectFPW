<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;
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

Route::prefix('/')->group(function () {
    Route::get('/', [AuthController::class, 'indexLogin'])->name('login');
    Route::post('/', [AuthController::class, 'doLogin'])->name('doLogin');
    Route::get('/register', [AuthController::class, 'indexRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'doRegister'])->name('doRegister');
    Route::get('/logout', [AuthController::class, 'doLogout'])->name('logout');
});

Route::prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'Home'])->name('user_home');
    Route::get('/project', [UserController::class, 'Project'])->name('user_project');
    Route::get('/add', [UserController::class, 'AddProject'])->name('user_add_project');
    Route::post('/add', [UserController::class, 'AddProject'])->name('user_add_project_post');
});

Route::prefix('file')->group(function () {
    Route::get('/', [FileController::class, 'Main'])->name('file_main');
    Route::get('/edit', [FileController::class, 'Edit'])->name('file_edit');
});
