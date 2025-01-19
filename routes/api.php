<?php

use Comrades\PhonePackage\Http\Controllers\PhoneController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/phone')->group(function () {
    Route::post('send', [PhoneController::class, 'send']);
    Route::post('confirm', [PhoneController::class, 'confirm']);
});
