<?php

use App\Http\Controllers\Admin\AdController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SmsWorkerController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
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

Route::name('frontend.')->group(function () {
    Route::get('/', [FrontendController::class, 'index'])->name('home');
});
 
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::prefix('admin')->middleware('admin')->group(function () {
        // Admin
        Route::get('/', [HomeController::class, 'admin_dashboard'])->name('admin.dashboard');
        Route::get('/track-visitor', [HomeController::class, 'trackVisit'])->name('track.visitor');

        Route::get('/setting', [SettingController::class, 'adminSetting'])->name('admin.setting');
        Route::post('/setting-update', [SettingController::class, 'adminSettingUpdate'])->name('admin.setting.update');
        
        Route::prefix('upload')->group(function () {
            Route::get('all', [UploadController::class, 'index'])->name('upload.index');
            Route::delete('delete', [UploadController::class, 'delete'])->name('upload.delete');
    
            Route::get('/get/uploaded/files/ajax', [UploadController::class, 'indexFetch'])->name('uploads.index.ajax');
            Route::get('/get/uploaded/files', [UploadController::class, 'getUploads'])->name('uploads.list');
            Route::post('/uploads/file/ajax', [UploadController::class, 'ajaxStore'])->name('uploads.store.ajax');
        });

        Route::resource('categories', CategoryController::class);
        Route::post('ajax/category/store', [CategoryController::class, 'ajax_category_store'])->name('ajax.category.store');
        Route::post('category/{id}/status', [CategoryController::class, 'updateStatus'])->name('category.update.status');
        
        Route::resource('pages', PageController::class);
        Route::post('page/{id}/status', [PageController::class, 'updateStatus'])->name('page.update.status');

        Route::resource('ads', AdController::class);
        Route::post('ad/{id}/status', [AdController::class, 'updateStatus'])->name('ad.update.status');

        Route::resource('jobs', JobController::class);
        Route::get('get-districts/{divisionId}', [JobController::class, 'getDistricts'])->name('get.districts');
        Route::get('get-thanas/{districtId}', [JobController::class, 'getThanas'])->name('get.thanas');
        Route::post('job/{id}/status', [JobController::class, 'updateStatus'])->name('jobs.update.status');

        Route::resource('sms-workers', SmsWorkerController::class);
        Route::get('/sms-workers/{id}/paid', [SmsWorkerController::class, 'paid'])->name('sms-workers.paid');

        Route::get('/manage-user', [HomeController::class, 'user_manage'])->name('user.manage');
        Route::get('/user/{id}/show', [HomeController::class, 'user_show'])->name('user.show');
        Route::get('/user/{id}/set-role', [HomeController::class, 'user_set_role'])->name('user.set.role');
        Route::put('/user/{id}/update-role', [HomeController::class, 'user_update_role'])->name('user.update.role');
        Route::post('/user-status-update/{id}', [HomeController::class, 'user_update_status'])->name('user.update.status');

        Route::resource('roles', RoleController::class);
        
    });

    Route::get('/dashboard', function () {
        return redirect(route('admin.dashboard'));
    })->name('dashboard');
});
