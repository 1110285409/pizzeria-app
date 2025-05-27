<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RawMaterialController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\PizzaRawMaterialController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {
    Route::resource('clients', ClientController::class);
});

Route::middleware('auth')->group(function () {
    Route::resource('employees', EmployeeController::class);
});

Route::middleware('auth')->group(function () {
    Route::resource('pizzas', PizzaController::class);
});

Route::middleware('auth')->group(function () {
    Route::resource('ingredients', IngredientController::class);
});

Route::middleware('auth')->group(function () {
    Route::resource('branches', BranchController::class);
});

Route::middleware('auth')->group(function () {
    Route::resource('raw-materials', RawMaterialController::class);
});

Route::middleware('auth')->group(function () {
    Route::resource('suppliers', SupplierController::class);
});

Route::middleware('auth')->group(function () {
    Route::resource('purchases', PurchaseController::class);
});

Route::middleware('auth')->group(function () {
    Route::resource('orders', OrderController::class);
    Route::patch('orders/{order}/status', [OrderController::class, 'update'])->name('orders.update.status');
});

Route::middleware(['auth', 'role:empleado'])->group(function () {
    Route::get('/pizzas/{pizza}/materias-primas', [PizzaRawMaterialController::class, 'edit'])->name('pizzas.raw_materials.edit');
    Route::post('/pizzas/{pizza}/materias-primas', [PizzaRawMaterialController::class, 'update'])->name('pizzas.raw_materials.update');
});
require __DIR__.'/auth.php';
