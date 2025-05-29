<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\PizzaController;
use App\Http\Controllers\Api\BranchController;
use App\Http\Controllers\Api\IngredientController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\RawMaterialController;



Route::apiResource('pizzas', PizzaController::class);
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::apiResource('branches', BranchController::class);
Route::apiResource('ingredients', IngredientController::class);
Route::apiResource('branches', BranchController::class);
Route::apiResource('employees', EmployeeController::class);
Route::apiResource('pizzas', PizzaController::class);
Route::apiResource('orders', OrderController::class);
Route::apiResource('raw-materials', RawMaterialController::class);