<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Product\ProductController;
use App\Http\Controllers\Api\Service\ServiceController;
use App\Http\Controllers\Api\Service\TagController;
use App\Http\Controllers\Api\Service\BrandController;
use App\Http\Controllers\Api\Service\ShippingClassController;
use App\Http\Controllers\Api\Service\AttributeController;
use App\Http\Controllers\Api\Service\CategoryController;
use App\Http\Controllers\Api\Comment\CommentController;
use App\Http\Controllers\Api\Coupon\CouponController;
use App\Http\Controllers\Api\Crossell\CrossellController;
use App\Http\Controllers\Api\Download\DownloadController;
use App\Http\Controllers\Api\Inventory\InventoryController;
use App\Http\Controllers\Api\Like\LikeController;
use App\Http\Controllers\Api\Media\MediaController;
use App\Http\Controllers\Api\Option\OptionController;
use App\Http\Controllers\Api\Review\ReviewController;
use App\Http\Controllers\Api\SoldWith\SoldWithController;
use App\Http\Controllers\Api\Unit\UnitController;
use App\Http\Controllers\Api\Upsell\UpsellController;

use App\Http\Controllers\Api\Auth\RegisterUserController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;



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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

        ////// Public routes  /////
    Route::post('register', [RegisterUserController::class, 'RegisterUser'])->name('register');
    Route::post('login',[ LoginController::class , 'login'])->name('login');
    


    /////////   Inventory module routes     ////////////
Route::middleware('auth:api')->group( function(){
    
     // logout route
     Route::post('logout',[ LogoutController::class , 'logout'])->name('logout');

     // Product resource route
     Route::apiResource('product', ProductController::class);

     // Service resource route
     Route::apiResource('service', ServiceController::class);

     // Tag route
     Route::apiResource('tag', TagController::class);
    
    // Shipping-class route
    Route::apiResource('shipping-class', ShippingClassController::class);
    
    // Brand route
    Route::apiResource('brand', BrandController::class);
   
    // Attribute route
    Route::apiResource('attribute', AttributeController::class);
   
    // Category route
    Route::apiResource('category', CategoryController::class);

    // Comment route
    Route::apiResource('comment', CommentController::class);

    // Coupon route
    Route::apiResource('coupon', CouponController::class);

    // Crossell route
    Route::apiResource('crossell', CrossellController::class);

    // Download route
    Route::apiResource('download', DownloadController::class);

    // Inventory route
    Route::apiResource('inventory', InventoryController::class);

    // Like route
    Route::apiResource('like', LikeController::class);

    // Media route
    Route::apiResource('media', MediaController::class);

    // Option route
    Route::apiResource('option', OptionController::class);

    // Review route
    Route::apiResource('review', ReviewController::class);

    // SoldWith route
    Route::apiResource('sold-with', SoldWithController::class);

    // Unit route
    Route::apiResource('unit', UnitController::class);

    // Upsellroute
    Route::apiResource('upsell', UpsellController::class);

} );


// Default fallback route if route not found
Route::fallback(function(){
    return response()->json([
        'error' => 'Page Not Found. Make sure the URL is correctly typed',
        'error code' => '404'
         ], 404);
});
 

