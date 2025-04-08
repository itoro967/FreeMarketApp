<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TradeMessageController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Middleware\NotVerifiedLogout;
use App\Http\Middleware\IsSetProfile;
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

Route::middleware([NotVerifiedLogout::class, IsSetProfile::class])->group(function () {
  Route::get('/', [ItemController::class, 'index']);
  Route::get('/register', [UserController::class, 'register']);
  Route::get('/item/{item_id}', [ItemController::class, 'detail']);
});

Route::middleware(['auth', 'verified', IsSetProfile::class])->group(function () {
  Route::prefix('mypage')->group(function () {
    Route::get('profile', [UserController::class, 'editProfile']);
    Route::post('profile', [UserController::class, 'changeProfile']);
    Route::get('', [UserController::class, 'mypage'])->name('mypage');
  });
  Route::prefix('item')->group(function () {
    Route::post('addcomment', [CommentController::class, 'addComment']);
    Route::post('favorite', [FavoriteController::class, 'favorite']);
  });
  Route::prefix('purchase')->group(function () {
    Route::get('{item_id}', [ItemController::class, 'purchase']);
    Route::put('{item_id}', [ItemController::class, 'purchase']);
    Route::post('{item_id}', [OrderController::class, 'sold']);
    Route::get('address/{item_id}', [OrderController::class, 'editAddress']);
  });

  Route::get('/sell', [ItemController::class, 'sell']);
  Route::post('/sell', [ItemController::class, 'store']);
  Route::get('/logout', [UserController::class, 'logout']);

  Route::get('/trading/item/{item_id}', [TradeMessageController::class, 'chat'])->name('tradingMessage.chat');
  Route::post('/trading/message', [TradeMessageController::class, 'store'])->name('tradingMessage.store');
  Route::post('/trading/message/destroy', [TradeMessageController::class, 'destroy'])->name('tradingMessage.destroy');
  Route::post('/trading/message/correct', [TradeMessageController::class, 'correct'])->name('tradingMessage.correct');
  Route::post('/trading/complete', [OrderController::class, 'complete'])->name('tradingMessage.complete');

});

Route::get('/email/verify', function () {
  return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
  $request->fulfill();

  return redirect('/mypage/profile');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
  $request->user()->sendEmailVerificationNotification();

  return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
