<?php

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

Route::post('/login',[UserApiController::class, 'autentikasi']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/logout',[UserApiController::class, 'logout']);

// Route::post('/logout', function (Request $request) {
//     if (Auth::check()) {
//         Auth::logout();
//         return response()->json(['message' => 'Logged out successfully']);
//     } else {
//         return response()->json(['message' => 'You are not logged in'], 401);
//     }
// });