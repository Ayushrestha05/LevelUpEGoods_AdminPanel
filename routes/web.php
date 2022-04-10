<?php

use App\Http\Controllers\PushNotificationController;
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
    Route::resource('/report/report-question',\App\Http\Controllers\ReportQuestionTypeController::class);
    Route::resource('/report/user-reports',\App\Http\Controllers\ReportController::class);
    Route::resource('/categories',\App\Http\Controllers\CategoriesController::class);
    Route::resource('/items/music',\App\Http\Controllers\MusicController::class);
    Route::resource('/items/gift-card',\App\Http\Controllers\GiftCardController::class);
    Route::resource('/items/figurine',\App\Http\Controllers\FigurineController::class);
    Route::resource('/items/illustrations',\App\Http\Controllers\IllustrationController::class);
    Route::resource('/platforms',\App\Http\Controllers\PlatformController::class);
    Route::resource('/items/games',\App\Http\Controllers\GameController::class);
    Route::resource('/orders/pending',\App\Http\Controllers\PendingOrderController::class, ['except' => ['create', 'store']]);
    Route::resource('/orders/completed',\App\Http\Controllers\CompletedOrderController::class, ['except' => ['create', 'store']]);
    Route::resource('/reward-items',\App\Http\Controllers\RewardItemController::class,['except' => ['show']]);
    Route::resource('/reward-history', \App\Http\Controllers\RewardHistoryController::class, ['except' => ['create', 'store','show','destroy']]);
    Route::resource('/sale/checkout',\App\Http\Controllers\CheckoutSaleController::class);
    Route::resource('/artist',\App\Http\Controllers\ArtistController::class);
    // Notification Controllers
    Route::resource('/notifications', \App\Http\Controllers\PushNotificationController::class);
    Route::post('send',[\App\Http\Controllers\PushNotificationController::class, 'bulksend'])->name('bulksend');
});