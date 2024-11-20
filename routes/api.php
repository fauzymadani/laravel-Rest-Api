<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\InvoiceController;

Route::get("/user", function (Request $request) {
    return $request->user();
})->middleware("auth:sanctum");

// Route::group(
//     ["prefix" => "v1", "namespace" => "App\Http\Controllers\Api\V1"],
//     function () {
//         Route::apiResource("customers", CustomerControllers::class);
//     }
// );
Route::group(["prefix" => "v1"], function () {
    Route::apiResource("customers", CustomerController::class);
    Route::apiResource("invoices", InvoiceController::class);
});
