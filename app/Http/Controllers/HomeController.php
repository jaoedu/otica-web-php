<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\Order;

class HomeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HOME (LISTAGEM DE PRODUTOS)
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $products = Product::with('activePromotion')
            ->where('is_active', true)
            ->latest()
            ->get();

        return view('home', compact('products'));
    }

    /*
    |--------------------------------------------------------------------------
    | HISTÓRICO DE PEDIDOS
    |--------------------------------------------------------------------------
    */
    public function orders()
    {
        $orders = Order::with('items.product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orders', compact('orders'));
    }
}
