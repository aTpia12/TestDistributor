<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;

//Customers
Route::apiResource('customers', CustomerController::class)->names('api.v1.customers');

//Products
Route::apiResource('products', ProductController::class)->names('api.v1.products');
