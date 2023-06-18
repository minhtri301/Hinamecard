<?php

use App\Http\Controllers\Frontend\IndexController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\SinglePageController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\HomeController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/cong-dao-tao', [SinglePageController::class, 'getDaoTao'])->name('home.cong_dao_tao');

// Route::get('/ket-qua-tuyen-sinh', [SinglePageController::class, 'getDaoTao'])->name('home.ket_qua_tuyen_sinh');

// Route::get('/thu-vien-so', [SinglePageController::class, 'getDaoTao'])->name('home.thu_vien_so');

// Route::get('/cam-nang-tuyen-sinh', [SinglePageController::class, 'getDaoTao'])->name('home.cam_nang_tuyen_sinh');

// Route::get('/hoat-dong-khoa-hoc', [SinglePageController::class, 'getDaoTao'])->name('home.hoat_dong_khoa_hoc');

// Route::get('/cong-khai', [SinglePageController::class, 'getDaoTao'])->name('home.cong_khai');

Route::group(['namespace' => 'Frontend'], function()
{
    Route::group(['middleware' => ['check-auth-customer']], function(){

        Route::get('/information', [IndexController::class, 'details'])->name('home.page.details');

        Route::get('/', [IndexController::class, 'index'])->name('home.page.index');

        Route::get('/preview', [IndexController::class, 'preview'])->name('home.preview.get');

    });

    Route::get('login', [AccountController::class, 'getLogin'])->name('home.login');

    Route::get('logout', [AccountController::class, 'Logout'])->name('home.logout');

    Route::post('login', [AccountController::class, 'postLogin'])->name('home.login.post');

    Route::get('/page/{slug}', [PageController::class,'getCatePage'])->name('home.page_sub');

    Route::get('/{slug}', [IndexController::class, 'shareCard'])->name('home.get.shareCard'); 

    Route::post('/information/update', [IndexController::class, 'update'])->name('home.page.update');

    Route::get('/information/loadCard', [IndexController::class, 'loadCard'])->name('home.get.loadcard');

    Route::get('/information/edit/{id}', [IndexController::class, 'editCard'])->name('home.get.edit');

    Route::get('/information/delete/{id}', [IndexController::class, 'deleteCard'])->name('home.delete.card');

    Route::get('/information/updateCard', [IndexController::class, 'updateCard'])->name('home.post.update.card');

    Route::get('/card-update-position', [IndexController::class,'card_update_position'])->name('card.update.position');
   
});






