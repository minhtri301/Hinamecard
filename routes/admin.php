<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\ManagementController; 
use App\Http\Controllers\Admin\GroupManagementController;
use App\Http\Controllers\Admin\AppStoreController;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\PagesSubController;
use App\Http\Livewire\Livewire;

Route::group(['prefix' => 'admin'], function() {
    Auth::routes(['forgot' => false, 'verify' => false]);
});

Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function() {
    //Hone admin
    Route::get('/', [HomeController::class, 'index'])->name('admin.home');

     // Get layout
    Route::get('/get-layout', [HomeController::class, 'getLayOut'])->name('get.layout');

    

    Route::get('group-management/{id}', [GroupManagementController::class, 'getGroupEdit'])->name('get.group.edit');
    Route::get('group-management/delete/{id}', [GroupManagementController::class, 'deleteGroup'])->name('delete.group');
    Route::post('group-management/post/{id}', [GroupManagementController::class, 'postGroupEdit'])->name('post.group.edit');

    Route::get('management/reload-Code', [ManagementController::class, 'reloadCode'])->name('management.reload.code');
    Route::post('management/update/{id}', [ManagementController::class, 'update'])->name('management.post.update');
    Route::get('management/delete/{id}', [ManagementController::class, 'delete'])->name('management.get.delete');

    Route::post('managementAdmin/update/{id}', [AdminManagementController::class, 'update'])->name('managementAdmin.post.update');
    Route::get('managementAdmin/delete/{id}', [AdminManagementController::class, 'delete'])->name('managementAdmin.get.delete');

    Route::get('app-store/edit/{id}', [AppStoreController::class, 'edit'])->name('get.app.edit');
    Route::post('app-store/update', [AppStoreController::class, 'update'])->name('post.app.update');
    Route::get('app-store/delete/{id}', [AppStoreController::class, 'delete'])->name('get.app.delete');
    
    //Resourcessearch.group

    Route::resource( 'app-store' ,AppStoreController::class);
    Route::resource( 'management', ManagementController::class);
    Route::resource( 'managementAdmin', AdminManagementController::class);
    Route::resource( 'group-management', GroupManagementController::class);
    Route::resource( 'page-sub', PagesSubController::class);
    Route::resource( 'roles', RolesController::class);

    //Roles
    Route::post('roles/addPermission', [RolesController::class,'addPermission'])->name('roles.addPermission');

       //Setting
    Route::group(['prefix' => 'settings'], function() {
    Route::get('/general', [SettingsController::class,'getGeneralConfig'])->name('admin.settings.general');
    Route::post('/general', [SettingsController::class,'postGeneralConfig'])->name('admin.settings.general.post');
    });

    // Cấu hình trang đơn
    // Route::group(['prefix' => 'pages-sub'], function() {
    //     Route::get('/', [PagesController::class,'getListPages'])->name('pages.list');
    //     Route::get('build', [PagesController::class,'getBuildPages'])->name('pages.build');
    //     Route::post('build', [PagesController::class,'postBuildPages'])->name('pages.build.post');
    //     Route::post('create', [PagesController::class,'postCreatePages'])->name('pages.create');
    // });
    
});