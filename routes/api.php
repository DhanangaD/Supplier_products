<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;

Route::apiResource('/suppliers', SupplierController::class);
