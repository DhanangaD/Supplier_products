<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;


Route::get('/', function () {
    return view('welcome');
});


Route::apiResource('/suppliers', SupplierController::class);
// Route::apiResource('/add-supplier', SupplierController::class);

