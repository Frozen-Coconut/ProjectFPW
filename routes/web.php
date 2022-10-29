<?php

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

Route::get('/', function () {
    return view('main');
})->name('main');

Route::prefix('file')->group(function () {
    Route::get('/', function () {
        return view('file.main');
    })->name('file_main');
    Route::get('/edit', function () {
        return view('file.edit');
    })->name('file_edit');
});
