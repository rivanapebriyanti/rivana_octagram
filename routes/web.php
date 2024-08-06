<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[UserController::class,'login']);
Route::post('/auth',[UserController::class,'autentikasi']);
Route::get('/logout',[UserController::class,'logout']);
Route::middleware(['login'])->group(function(){
    Route::get('/user',[UserController::class, 'user']);
    Route::get('/user',[UserController::class, 'show_user']);
    Route::post('/form-user',[UserController::class, 'create']);
    Route::get('/form-user',[UserController::class, 'add']);
    Route::get('/update/{id}',[UserController::class,'edit']);
    Route::post('/update/{id}',[UserController::class,'update']);
    Route::get('/destroy/{id}',[UserController::class,'delete']);


    Route::get('/index',[CategoryController::class,'index']);



    Route::get('/category',[CategoryController::class, 'category']);
    Route::get('/create',[CategoryController::class,'add']);
    Route::post('/create',[CategoryController::class,'create']);
    Route::post('/search',[CategoryController::class,'search']);
    Route::get('/delete/{id}',[CategoryController::class,'delete']);
    Route::get('/edit/{id}',[CategoryController::class,'edit']);
    Route::post('/edit/{id}',[CategoryController::class,'update']);
});