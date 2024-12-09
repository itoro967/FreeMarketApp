<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
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

Route::get('/', [ItemController::class, 'index']);
Route::get('/register', [UserController::class, 'register']);
Route::get('/mypage/profile', [UserController::class, 'editProfile']);
Route::post('/mypage/profile', [UserController::class, 'changeProfile']);
Route::get('/mypage', [UserController::class, 'mypage']);
Route::get('/logout', [UserController::class, 'logout']);
Route::get('/item/{item_id}', [ItemController::class, 'detail']);
Route::post('/item/addcomment', [CommentController::class, 'addComment']);
Route::post('/item/favorite', [FavoriteController::class, 'favorite']);
Route::get('/purchase/{item_id}', [ItemController::class, 'purchase']);
Route::put('/purchase/{item_id}', [ItemController::class, 'purchase']);
Route::post('/purchase/{item_id}', [ItemController::class, 'sold']);
Route::get('/purchase/address/{item_id}', [UserController::class, 'editAddress']);
Route::get('/sell', [ItemController::class, 'sell']);
Route::post('/sell', [ItemController::class, 'store']);
