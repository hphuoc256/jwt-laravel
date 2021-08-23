<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReplyCommentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BrandController;
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
Route::get('/greeting', function () {
    return 'Hello World';
});
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);  
    Route::put('/user-profile', [AuthController::class, 'editProfile']);  
    
});
Route::group(['middleware' => ['jwt.auth'] ], function () {
    Route::group(['prefix' => 'category'], function () {
        Route::get('list-category', [CategoryController::class, 'listCategory']);  
        Route::post('add-category', [CategoryController::class, 'addCategory']);
        Route::get('edit-category/{id}', [CategoryController::class, 'getCategory']); 
        Route::put('edit-category/{id}', [CategoryController::class, 'updateCategory']);
        Route::delete('delete-category/{id}', [CategoryController::class, 'deleteCategory']);
    });

    Route::group(['prefix' => 'brand'], function () {
        Route::get('list-brand', [BrandController::class, 'listBrand']);  
        // Route::post('add-brand', [BrandController::class, 'addBrand']);
        // Route::get('edit-brand/{id}', [BrandController::class, 'getBrand']); 
        // Route::put('edit-brand/{id}', [BrandController::class, 'updateBrand']);
        // Route::delete('delete-brand/{id}', [BrandController::class, 'deleteBrand']);
    });

    Route::group(['prefix' => 'product'], function () {
        Route::get('list-product', [ProductController::class, 'listProduct']);  
        Route::post('add-product', [ProductController::class, 'addProduct']);
        Route::get('edit-product/{id}', [ProductController::class, 'getProduct']); 
        Route::put('edit-product/{id}', [ProductController::class, 'updateProduct']);
        Route::delete('delete-product/{id}', [ProductController::class, 'deleteProduct']);
        Route::get('hot-product', [ProductController::class, 'hotProduct']);
        Route::get('sell-product', [ProductController::class, 'sellProduct']);
        Route::get('new-product', [ProductController::class, 'newProduct']);
        Route::get('info-product/{id}', [ProductController::class, 'infoProduct']); 
        
        Route::post('add-image-product', [ProductController::class, 'addImage']);

    });

    Route::group(['prefix' => 'comment'], function () {
        Route::get('list-comment', [CommentController::class, 'listComment']); 
        Route::post('add-comment', [CommentController::class, 'addComment']);
        Route::get('edit-comment/{id}', [CommentController::class, 'getComment']); 
        Route::put('edit-comment/{id}', [CommentController::class, 'updateComment']);
        Route::delete('delete-comment/{id}', [CommentController::class, 'deleteComment']);
    });

    Route::group(['prefix' => 'reply-comment'], function () {
        Route::get('list-reply-comment', [ReplyCommentController::class, 'listReplyComment']); 
        Route::post('add-reply-comment', [ReplyCommentController::class, 'addReplyComment']);
        Route::get('edit-reply-comment/{id}', [ReplyCommentController::class, 'getReplyComment']); 
        Route::put('edit-reply-comment/{id}', [ReplyCommentController::class, 'updateReplyComment']);
        Route::delete('delete-reply-comment/{id}', [ReplyCommentController::class, 'deleteReplyComment']);
    });

    Route::group(['prefix' => 'cart'], function () {
        Route::get('list-cart', [CartController::class, 'listCart']);
        Route::get('add-cart/{id}', [CartController::class, 'addCart']);

    });
});

