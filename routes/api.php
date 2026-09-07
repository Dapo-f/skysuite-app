<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register',[UserController::class, 'store']);
Route::post('/verify', [UserController::class, 'verifyEmail']);
Route::post('/resend/verification', [UserController::class, 'resendEmailVerification']);
