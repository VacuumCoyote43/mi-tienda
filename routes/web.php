<?php

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CharacteristicController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Auth::routes();

/*
|--------------------------------------------------------------------------
| Documentation Route
|--------------------------------------------------------------------------
*/
Route::get('/docs', function () {
    $readme = File::get(base_path('README.md'));
    return view('docs', ['content' => $readme]);
})->name('docs')->withoutMiddleware('auth');

// artisan seed
Route::get('/seed', function () {
    Artisan::call('db:seed');
    return redirect()->back()->with('success', 'Database seeded successfully');
})->name('seed');

// fresh
Route::get('/fresh', function () {
    Artisan::call('migrate:fresh --seed');
    return redirect()->back()->with('success', 'Database seeded successfully');
})->name('fresh');

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::name('shop.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Shop\HomeController::class, 'index'])->name('home');

    Route::middleware(['auth'])->group(function () {
        // Cart Routes
        Route::get('/cart', [\App\Http\Controllers\Shop\CartController::class, 'index'])->name('cart.index');
        Route::post('/cart', [\App\Http\Controllers\Shop\CartController::class, 'store'])->name('cart.store');
        Route::put('/cart/{cart}', [\App\Http\Controllers\Shop\CartController::class, 'update'])->name('cart.update');
        Route::delete('/cart/{cart}', [\App\Http\Controllers\Shop\CartController::class, 'destroy'])->name('cart.destroy');

        // Order Routes
        Route::get('/orders', [\App\Http\Controllers\Shop\OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/create', [\App\Http\Controllers\Shop\OrderController::class, 'create'])->name('orders.create');
        Route::post('/orders', [\App\Http\Controllers\Shop\OrderController::class, 'store'])->name('orders.store');
        Route::get('/orders/{order}', [\App\Http\Controllers\Shop\OrderController::class, 'show'])->name('orders.show');
    });
});

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->as('admin.')->group(function () {
    // Dashboard
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');

    // Products Management
    Route::resource('product', ProductController::class);

    // Categories Management
    Route::resource('category', CategoryController::class);

    // Characteristics Management
    Route::resource('characteristic', CharacteristicController::class);

    // Users Management
    Route::resource('user', UserController::class);

    // Orders Management
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
});

/*
|--------------------------------------------------------------------------
| Route Name Reference
|--------------------------------------------------------------------------
|
| Products:
| - product.index   -> GET|HEAD  /product
| - product.create  -> GET|HEAD  /product/create
| - product.store   -> POST      /product
| - product.show    -> GET|HEAD  /product/{product}
| - product.edit    -> GET|HEAD  /product/{product}/edit
| - product.update  -> PUT|PATCH /product/{product}
| - product.destroy -> DELETE    /product/{product}
|
| Categories:
| - category.index   -> GET|HEAD  /category
| - category.create  -> GET|HEAD  /category/create
| - category.store   -> POST      /category
| - category.show    -> GET|HEAD  /category/{category}
| - category.edit    -> GET|HEAD  /category/{category}/edit
| - category.update  -> PUT|PATCH /category/{category}
| - category.destroy -> DELETE    /category/{category}
|
| Characteristics:
| - characteristic.index   -> GET|HEAD  /characteristic
| - characteristic.create  -> GET|HEAD  /characteristic/create
| - characteristic.store   -> POST      /characteristic
| - characteristic.show    -> GET|HEAD  /characteristic/{characteristic}
| - characteristic.edit    -> GET|HEAD  /characteristic/{characteristic}/edit
| - characteristic.update  -> PUT|PATCH /characteristic/{characteristic}
| - characteristic.destroy -> DELETE    /characteristic/{characteristic}
*/
