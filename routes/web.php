<?php

use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/admin/home',[\App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin-home')->middleware('is_admin');
// Route::get('/admin/report-question',[\App\Http\Controllers\ReportQuestionController::class, 'index'])->name('admin-report-question')->middleware('is_admin');
//Route::resource('/admin/report-question',\App\Http\Controllers\ReportQuestionController::class)->middleware('is_admin');

Route::prefix('admin')->name('admin.')->middleware('is_admin')->group(function () {
    Route::get('/home',[\App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin-home');
    Route::resource('/report-question',\App\Http\Controllers\ReportQuestionController::class);
});