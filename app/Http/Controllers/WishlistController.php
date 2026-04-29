<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function toggle(Product $product)
    {
        $user = Auth::user();

        if ($user->wishlist()->where('product_id', $product->id)->exists()) {
            $user->wishlist()->detach($product->id);

            return back()->with('success', 'Produto removido da wishlist.');
        }

        $user->wishlist()->attach($product->id);

        return back()->with('success', 'Produto adicionado à wishlist.');
    }

    public function destroy(Product $product)
    {
        Auth::user()->wishlist()->detach($product->id);

        return back()->with('success', 'Produto removido da wishlist.');
    }
}
