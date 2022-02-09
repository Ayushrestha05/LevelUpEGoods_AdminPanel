<?php

use App\Http\Controllers\API\AuthAPIController;
use App\Http\Controllers\API\ReportQuestionAPIController;
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

Route::get('/report-questions', [ReportQuestionAPIController::class, 'index']);

Route::post('/login', [AuthAPIController::class, 'login']);
Route::post('/register', [AuthAPIController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('/logout', [AuthAPIController::class, 'logout']);
});