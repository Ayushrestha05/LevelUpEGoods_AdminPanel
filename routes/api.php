<?php

use App\Http\Controllers\API\AuthAPIController;
use App\Http\Controllers\API\CartAPIController;
use App\Http\Controllers\API\CategoriesAPIController;
use App\Http\Controllers\API\ForgotPasswordController;
use App\Http\Controllers\API\ItemAPIController;
use App\Http\Controllers\API\MusicAPIController;
use App\Http\Controllers\API\OrdersAPIController;
use App\Http\Controllers\API\PaymentVerificationAPIController;
use App\Http\Controllers\API\ReportQuestionAPIController;
use App\Http\Controllers\API\ResetPasswordController;
use App\Http\Controllers\API\ReviewAPIController;
use App\Http\Controllers\API\UserReportAPIController;
use App\Http\Controllers\API\WishlistAPIController;
use App\Http\Controllers\API\PointsAPIController;
use App\Http\Controllers\API\RewardItemAPIController;
use App\Http\Controllers\API\SearchAPIController;
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
Route::get('/items/category/{category_id}', [ItemAPIController::class, 'getItems']);
Route::get('/items/music-data/{item_id}', [ItemAPIController::class, 'getMusicData']);
Route::get('/items/gift-card-data/{item_id}', [ItemAPIController::class, 'getGiftCardData']);
Route::get('/items/figurine-data/{item_id}', [ItemAPIController::class, 'getFigurineData']);
Route::get('/items/illustration-data/{item_id}', [ItemAPIController::class, 'getIllustrationData']);
Route::get('/items/game-data/{item_id}', [ItemAPIController::class, 'getGameData']);
Route::get('/reviews/{item_id}', [ReviewAPIController::class, 'getReviews']);
Route::post('/forgot-password',[ForgotPasswordController::class, 'forgotPassword']);
Route::post('/verify/pin',[ForgotPasswordController::class, 'verifyPin']);
Route::post('/reset-password',[ResetPasswordController::class, 'resetPassword']);
Route::get('/reward-items', [RewardItemAPIController::class, 'getRewardItems']);
Route::post('/search', [SearchAPIController::class, 'search']);

//Private API Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthAPIController::class, 'logout']);
    Route::post('/submit-report', [UserReportAPIController::class, 'submitReport']);
    Route::prefix('cart')->group(function(){
        Route::post('/add',[CartAPIController::class, 'addToCart']);
        Route::get('/get', [CartAPIController::class, 'getCart']);
        Route::post('/remove', [CartAPIController::class, 'removeFromCart']);
        Route::post('/increase', [CartAPIController::class, 'increaseQuantity']);
        Route::post('/decrease', [CartAPIController::class, 'decreaseQuantity']);
    });
    Route::post('/add-review', [ReviewAPIController::class, 'addReview']);
    Route::post('/add-wishlist',[WishlistAPIController::class,'addToWishlist']);
    Route::post('/remove-wishlist',[WishlistAPIController::class,'removeFromWishlist']);
    Route::get('/get-wishlist',[WishlistAPIController::class,'getWishlist']);
    Route::get('/in-wishlist/{item_id}',[WishlistAPIController::class,'inWishlist']);
    Route::post('/payment-verification',[PaymentVerificationAPIController::class,'validatePayment']);
    Route::post('/get-orders',[OrdersAPIController::class,'getOrders']);
    Route::get('/get-order-details/{order_id}',[OrdersAPIController::class,'getOrderDetails']);
    Route::get('/get-user-review/{item_id}',[ReviewAPIController::class,'checkUserReview']);
    Route::post('/update-user-review',[ReviewAPIController::class,'updateUserReview']);
    Route::get('/get-user-reviews' , [ReviewAPIController::class, 'getUserReviews']);
    Route::post('/delete-review', [ReviewAPIController::class, 'deleteReview']);
    Route::get('/get-user-points', [PointsAPIController::class, 'getUserPoints']);
    Route::post('/redeem-item',[RewardItemAPIController::class,'redeemReward']);
    Route::get('/get-redeemed-items',[RewardItemAPIController::class,'getRewardHistory']);
});