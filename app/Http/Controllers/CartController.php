<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $items = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $total = $items->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('cart', compact('items', 'total'));
    }

    public function add($id)
    {
        $product = Product::findOrFail($id);

        $item = CartItem::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($item) {
            $item->increment('quantity');
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return back()->with('success', 'Produto adicionado ao carrinho.');
    }

    public function increase($id)
    {
        $item = CartItem::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $item->increment('quantity');

        return back();
    }

    public function decrease($id)
    {
        $item = CartItem::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        if ($item->quantity > 1) {
            $item->decrement('quantity');
        } else {
            $item->delete();
        }

        return back();
    }

    public function remove($id)
    {
        $item = CartItem::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $item->delete();

        return back()->with('success', 'Produto removido do carrinho.');
    }
}
