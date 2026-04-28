<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Mostrar tela checkout
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $userId = Auth::id();

        $items = CartItem::with('product')
            ->where('user_id', $userId)
            ->get();

        if ($items->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Carrinho vazio');
        }

        $total = $items->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('checkout', compact('items', 'total'));
    }

    /*
    |--------------------------------------------------------------------------
    | Finalizar compra
    |--------------------------------------------------------------------------
    */
    public function process(Request $request)
    {
        $userId = Auth::id();

        $items = CartItem::with('product')
            ->where('user_id', $userId)
            ->get();

        if ($items->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Carrinho vazio');
        }

        $order = DB::transaction(function () use ($items, $userId) {

            $total = $items->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

            $order = Order::create([
                'user_id' => $userId,
                'total' => $total,
                'status' => 'pendente',
            ]);

            foreach ($items as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->product->price,
                ]);
            }

            CartItem::where('user_id', $userId)->delete();

            return $order;
        });

        return redirect()
            ->route('prescription.create', $order->id)
            ->with('success', 'Pedido criado! Agora envie sua receita.');
    }
}