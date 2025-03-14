<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserUploadFavouriteController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);


Route::middleware([
    'auth:sanctum',
])->group(function () {

    Route::get('/user', function () {
        return response()->json([
            'user' => auth()->user(),
        ]);
    });

    Route::post('/auth/logout', [AuthController::class, 'logout']);
  
    Route::group(['prefix'=> 'users'], function(){
        Route::get('/', [UserController::class, 'index']);
        Route::get('/{user}', [UserController::class, 'show']);
        Route::post('/', [UserController::class, 'store']);
        Route::put('/{user}', [UserController::class, 'update']);
        Route::delete('/{user}', [UserController::class, 'destroy']);
    });

    Route::group(['prefix'=> 'uploads'], function(){
        Route::get('/', [UploadController::class, 'index']);
        Route::get('/discover', [UploadController::class, 'discover']);
        Route::post('/', [UploadController::class, 'store']);
        Route::put('/{upload}', [UploadController::class, 'update']);
        Route::delete('/{upload}', [UploadController::class, 'destroy']);
        Route::put('/{upload}/like', [UploadController::class, 'like']);
        Route::delete('/{upload}/dislike', [UploadController::class, 'dislike']);
        Route::get('/favourites', [UploadController::class, 'getAllFavourites']);
        Route::put('/{upload}/favourite', [UploadController::class, 'favourite']);
        Route::delete('/{upload}/unfavourite', [UploadController::class, 'unfavourite']);
    });
    
});




