<?php

use App\Http\Controllers\ApiUserController;
use App\Http\Controllers\AuthApiController;
use App\Http\Controllers\CategoryApiController;
use App\Http\Controllers\UserApiController;
// use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::post('/login',[ApiUserController::class, 'autentikasi']);
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::get('/logout',[ApiUserController::class, 'logout']);

// Route::post('/logout', function (Request $request) {
//     if (Auth::check()) {
//         Auth::logout();
//         return response()->json(['message' => 'Logged out successfully']);
//     } else {
//         return response()->json(['message' => 'You are not logged in'], 401);
//     }
// });

Route::post('login', [AuthApiController::class, 'login']);

Route::middleware('authToken')->group(function(){
    Route::post('logout', [AuthApiController::class, 'logout']);
    Route::post('create/category', [CategoryApiController::class, 'create']);
    Route::get('category/get', [CategoryApiController::class,'get']);
    Route::post('category/update/{id}', [CategoryApiController::class,'update']);
    Route::get('category/delete/{id}', [CategoryApiController::class, 'delete']);
});