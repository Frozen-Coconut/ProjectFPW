<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ToDoController;

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
    Route::get('/project', [ProjectController::class, 'AddSession'])->name('user_project');
    Route::get('/add', [UserController::class, 'AddProject'])->name('user_add_project');
    Route::post('/add', [UserController::class, 'AddProjectPost'])->name('user_add_project_post');
    Route::get('/kalender', [UserController::class, 'IndexKalender'])->name('user_kalender');
    Route::get('/ajax-kalender', [UserController::class, 'Kalender']);
});

Route::prefix('project')->group(function () {
    Route::get('/', [ProjectController::class, 'Project'])->name('project_home');
    Route::get('/daftar-tugas', [ProjectController::class, 'DaftarTugas'])->name('project_daftar_tugas');
    Route::get('/add', [ProjectController::class, 'AddDaftarTugas'])->name('project_add_tugas');
    Route::post('/add', [ToDoController::class, 'CreateToDo'])->name('project_add_tugas_post');
    Route::post('/assign', [ToDoController::class, 'AssignToDo'])->name('project_assign_tugas_post');
});

Route::prefix('file')->group(function () {
    Route::get('/', [FileController::class, 'Main'])->name('file_main');
    Route::get('/edit', [FileController::class, 'Edit'])->name('file_edit');
});
