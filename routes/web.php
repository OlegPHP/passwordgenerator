<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordController;

Route::get('/', [PasswordController::class, 'index'])->name('index');
Route::post('/generate', [PasswordController::class, 'generate'])->name('generate');
Route::get('/generate', [PasswordController::class, 'generate'])->name('generate');

