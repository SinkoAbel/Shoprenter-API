<?php

use App\Http\Controllers\SecretController;
use Illuminate\Support\Facades\Route;

Route::get('/secret/{hash}', [SecretController::class, 'show']);
Route::post('/secret', [SecretController::class, 'store']);
