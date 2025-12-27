<?php

use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SmsWorkerController;
use App\Http\Controllers\Api\AppController;
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

Route::prefix('v1')->group(function () {
    Route::get('setting', [SettingController::class, 'apiSetting']);
    Route::get('check-latest-payment', [SmsWorkerController::class, 'checkLatestPayment']);
    Route::post('first-sms/{id}', [SmsWorkerController::class, 'firstSms']);
    Route::post('second-sms/{id}', [SmsWorkerController::class, 'secondSms']);
});