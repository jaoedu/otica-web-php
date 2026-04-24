<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        $user = Auth::user();

        if ($user && $user->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('home');
    })->name('dashboard');

    Route::get('/home', [HomeController::class, 'index'])
        ->name('home');

    // ========================
    // CART
    // ========================

    Route::prefix('cart')->name('cart.')->group(function () {

        Route::get('/', [CartController::class, 'index'])->name('index');

        Route::post('/add/{id}', [CartController::class, 'add'])->name('add');

        // 🔥 TROCA AQUI PRA GET (facilita debug e evita erro de form)
        Route::get('/increase/{id}', [CartController::class, 'increase'])->name('increase');
        Route::get('/decrease/{id}', [CartController::class, 'decrease'])->name('decrease');

        Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('remove');
    });
});

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('products', ProductController::class);
        Route::resource('promotions', PromotionController::class);
    });

require __DIR__ . '/auth.php';