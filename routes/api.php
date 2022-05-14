<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\SubscriptionController;
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

Route::prefix('posts')->group(function() {
    Route::get('/', [PostController::class, 'getPosts']);
    Route::post('/', [PostController::class, 'storePosts']);
    Route::put('/show', [PostController::class, 'getPost']);
    Route::put('/update', [PostController::class, 'updatePosts']);
    Route::delete('/delete', [PostController::class, 'deletePosts']);
});

Route::prefix('/subscriptions')->group(function() {
    Route::post('/subscribe', [SubscriptionController::class, 'subscribe']);
    Route::post('/unsubscribe', [SubscriptionController::class, 'unsubscribe']);
    
});