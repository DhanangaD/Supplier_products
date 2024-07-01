<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;

Route::apiResource('/suppliers', SupplierController::class);

Route::post('/suppliers', [SupplierController::class, 'store']);
Route::get('/suppliers', [SupplierController::class, 'index']);
Route::put('/suppliers/{supplier}', [SupplierController::class, 'update']);
Route::delete('/suppliers/{supplier}', [SupplierController::class, 'destroy']);
