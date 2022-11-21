<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SnapController;
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
    Route::get('/ajax-detail-kalender', [UserController::class, 'DetailKalender']);
});

Route::prefix('project')->group(function () {
    Route::get('/', [ProjectController::class, 'Project'])->name('project_home');
    Route::post('/post/add', [ProjectController::class, 'AddPost'])->name('project_add_post');
    Route::get('/post/detail', [ProjectController::class, 'DetailPost'])->name('project_detail_post');
    Route::post('/post/detail', [ProjectController::class, 'AddPostComment'])->name('project_add_post_comment');

    //Daftar Tugas
    Route::get('/daftar-tugas', [ProjectController::class, 'IndexDaftarTugas'])->name('project_daftar_tugas');
    Route::get('/ajax-daftar-tugas', [ProjectController::class, 'DaftarTugas']);
    Route::get('/update-custom-sort', [ProjectController::class, 'UpdateCustomSort']);
    Route::get('/notify', [ProjectController::class, 'NotifyLate'])->name('project_notify_late');
    Route::get('/detail-tugas', [ProjectController::class, 'IndexDetailTugas'])->name('project_detail_tugas');
    Route::get('/update-status', [ProjectController::class, 'UpdateStatus'])->name('project_update_status_to_do');
    Route::post('/add-comment', [ToDoController::class, 'Comment'])->name('project_add_comment');

    //Add
    Route::get('/add', [ProjectController::class, 'AddDaftarTugas'])->name('project_add_tugas');
    Route::post('/add', [ToDoController::class, 'CreateToDo'])->name('project_add_tugas_post');
    Route::post('/assign', [ToDoController::class, 'AssignToDo'])->name('project_assign_tugas_post');

    //Kalender
    Route::get('/kalender', [ProjectController::class, 'IndexKalender'])->name('project_kalender');
    Route::get('/ajax-kalender', [ProjectController::class, 'Kalender']);
    Route::get('/ajax-detail-kalender', [ProjectController::class, 'DetailKalender']);

    //Upgrade
    Route::get('/upgrade', [ProjectController::class, 'IndexUpgrade'])->name('project_upgrade');
    Route::get('/ajax-snapToken',[SnapController::class, 'GetSnap']);
    Route::get('/ajax-update', [SnapController::class, 'Receive']);
});

Route::prefix('file')->group(function () {
    Route::get('/', [FileController::class, 'Main'])->name('file_main');
    Route::get('/upload', [FileController::class, 'Upload'])->name('file_upload');
    Route::get('/edit', [FileController::class, 'Edit'])->name('file_edit');
});
