<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('activePromotion')
            ->where('is_active', true)
            ->latest()
            ->get();

        return view('home', compact('products'));
    }
}