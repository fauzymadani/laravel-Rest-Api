<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\InvoiceController;

// Route for getting the authenticated user (requires Sanctum auth middleware)
Route::get("/user", function (Request $request) {
    return $request->user();
})->middleware("auth:sanctum");

// Route group for API versioning (v1)
Route::group(["prefix" => "v1", "middleware" => "auth:sanctum"], function () {
    // API resources for customers and invoices
    Route::apiResource("customers", CustomerController::class); 
    Route::apiResource("invoices", InvoiceController::class);
});
