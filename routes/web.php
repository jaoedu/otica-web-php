<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PrescriptionController;

// Admin
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\AdminDashboardController;

/*
|--------------------------------------------------------------------------
| ROTA INICIAL
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| ROTAS PROTEGIDAS (USUÁRIO LOGADO)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | REDIRECIONAMENTO INTELIGENTE (ADMIN OU USER)
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', function () {
        $user = Auth::user();

        if ($user && $user->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('home');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | HOME
    |--------------------------------------------------------------------------
    */
    Route::get('/home', [HomeController::class, 'index'])
        ->name('home');

    /*
    |--------------------------------------------------------------------------
    | CARRINHO
    |--------------------------------------------------------------------------
    */
    Route::prefix('cart')->name('cart.')->group(function () {

        Route::get('/', [CartController::class, 'index'])->name('index');

        Route::post('/add/{id}', [CartController::class, 'add'])->name('add');

        Route::get('/increase/{id}', [CartController::class, 'increase'])->name('increase');
        Route::get('/decrease/{id}', [CartController::class, 'decrease'])->name('decrease');

        Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('remove');
    });

    /*
    |--------------------------------------------------------------------------
    | CHECKOUT
    |--------------------------------------------------------------------------
    */
    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout');

    Route::post('/checkout', [CheckoutController::class, 'process'])
        ->name('checkout.process');

    /*
    |--------------------------------------------------------------------------
    | PEDIDOS
    |--------------------------------------------------------------------------
    */
    Route::get('/orders', [HomeController::class, 'orders'])
        ->name('orders');

    /*
    |--------------------------------------------------------------------------
    | RECEITA
    |--------------------------------------------------------------------------
    */
    Route::prefix('prescription')->name('prescription.')->group(function () {

        Route::get('/{orderId}', [PrescriptionController::class, 'create'])
            ->name('create');

        Route::post('/{orderId}', [PrescriptionController::class, 'store'])
            ->name('store');
    });
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('products', ProductController::class);
        Route::resource('promotions', PromotionController::class);
    });

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';