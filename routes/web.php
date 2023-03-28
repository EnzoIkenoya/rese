<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
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

Route::get('/', [ShopController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
//breeze install


//店舗詳細ページ
Route::get('/detail/{shop_id}',[ShopController::class,'detail']);

//店舗検索
Route::post('/', [ShopController::class,'search']);

//reviewページ
Route::get('/review/{shop_id}', [ShopController::class,'review']);


//ログインしたユーザーのみ
Route::group(['middleware' => 'auth'], function() {
    //マイページ
    Route::get('/mypage', [MypageController::class, 'mypage']);

    //reserve確認
    Route::post('/reserve_check', [MypageController::class, 'reservecheck']);
    //reserve完了
    Route::post('/reserve_thanks', [MypageController::class, 'reservethanks']);

    //delete確認
    Route::post('/delete_check', [MypageController::class, 'deletecheck']);
    //delete完了
    Route::post('/delete_thanks', [MypageController::class, 'deletethanks']);

    //review投稿確認
    Route::post('/review_check', [MypageController::class, 'reviewcheck']);
    //review投稿完了
    Route::post('/review_thanks', [MypageController::class, 'reviewthanks']);

    //favorite追加
    Route::post('/favorite', [MypageController::class, 'favorite']);
    //favorite削除
    Route::post('/favo_destroy', [MypageController::class, 'destroy']);


//サイト管理者用ルーティング
    //管理画面
    Route::get('/manage', [ManageController::class,'manage']);

    //店舗管理者登録確認
    Route::post('/smr_check', [ManageController::class, 'smrc']);

    //店舗管理者登録完了
    Route::post('/smr_thanks', [ManageController::class, 'smrt']);


//ストアマネージャ用ルーティング
    //ストアマネージャ用画面
    Route::get('/storemanage', [StoremanagerController::class, 'storemanage']);

    //店舗詳細編集確認
    Route::post('/edit', [StoremanagerController::class, 'edit']);

    //店舗詳細編集完了
    Route::post('/completion', [StoremanagerController::class, 'completion']);
});
