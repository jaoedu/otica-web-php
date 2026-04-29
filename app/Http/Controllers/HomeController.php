<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;

class HomeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HOME
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        $search = $request->search;

        $query = Product::with('activePromotion')
            ->where('is_active', true)
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'ILIKE', "%{$search}%")
                        ->orWhere('description', 'ILIKE', "%{$search}%");
                });
            });

        $promotions = (clone $query)
            ->whereHas('activePromotion')
            ->latest()
            ->get();

        $products = (clone $query)
            ->whereDoesntHave('activePromotion')
            ->latest()
            ->get();

        return view('home', compact(
            'promotions',
            'products'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | PEDIDOS
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