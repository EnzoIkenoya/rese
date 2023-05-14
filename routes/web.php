<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ManageController;
use App\Http\Controllers\StoremanagerController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//ホーム
Route::get('/', [ShopController::class, 'index']);
Route::get('/search',[ShopController::class, 'search']);

Route::post('/favorite', [FavoriteController::class, 'create'])->name('favorite');
Route::post('/favorite/delete', [FavoriteController::class,'delete'])->name('favorite.delete');

//店舗詳細ページ
Route::prefix('detail')->group(function() {
    Route::get('', [ShopController::class, 'detail']);

    Route::prefix('reserve')->group(function () {
        Route::post('', [ReserveController::class, 'create'])->name('reserve');
        Route::post('delete', [ReserveController::class, 'delete'])->name('reserve.delete');
        Route::post('update',[ReserveController::class,'update'])->name('reserve.update');
    });

    Route::post('review', [ReviewController::class,'create'])->name('review');
});

//マイページ
Route::get('/mypage', [MypageController::class, 'mypage'])->middleware('auth');

require __DIR__.'/auth.php';