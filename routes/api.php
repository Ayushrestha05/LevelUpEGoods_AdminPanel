<?php

use App\Http\Controllers\API\AuthAPIController;
use App\Http\Controllers\API\CategoriesAPIController;
use App\Http\Controllers\API\ReportQuestionAPIController;
use App\Http\Controllers\API\UserReportAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Public API Routes
Route::get('/report-questions', [ReportQuestionAPIController::class, 'index']);
Route::post('/login', [AuthAPIController::class, 'login']);
Route::post('/register', [AuthAPIController::class, 'register']);
Route::get('/categories', [CategoriesAPIController::class, 'index']);

//Private API Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthAPIController::class, 'logout']);
    Route::post('/submit-report', [UserReportAPIController::class, 'submitReport']);
});