<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $userId = Auth::id();

        $items = CartItem::with('product')
            ->where('user_id', $userId)
            ->get();

        if ($items->isEmpty()) {
            return back()->with('error', 'Carrinho vazio');
        }

        DB::transaction(function () use ($items, $userId) {

            $total = $items->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

            $order = Order::create([
                'user_id' => $userId,
                'total' => $total,
            ]);

            foreach ($items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            CartItem::where('user_id', $userId)->delete();
        });

        return redirect()->route('orders')->with('success', 'Pedido realizado!');
    }
}