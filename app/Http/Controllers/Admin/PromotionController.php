<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::with('product')->latest()->get();

        return view('admin.promotions.index', compact('promotions'));
    }

    public function create()
    {
        $products = Product::where('is_active', true)->orderBy('name')->get();

        return view('admin.promotions.create', compact('products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'title' => ['required', 'string', 'max:255'],
            'discount_percent' => ['required', 'numeric', 'min:0', 'max:100'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
        ]);

        $data['is_active'] = $request->has('is_active');

        Promotion::create($data);

        return redirect()
            ->route('admin.promotions.index')
            ->with('success', 'Promoção cadastrada com sucesso.');
    }

    public function edit(Promotion $promotion)
    {
        $products = Product::where('is_active', true)->orderBy('name')->get();

        return view('admin.promotions.edit', compact('promotion', 'products'));
    }

    public function update(Request $request, Promotion $promotion)
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'title' => ['required', 'string', 'max:255'],
            'discount_percent' => ['required', 'numeric', 'min:0', 'max:100'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
        ]);

        $data['is_active'] = $request->has('is_active');

        $promotion->update($data);

        return redirect()
            ->route('admin.promotions.index')
            ->with('success', 'Promoção atualizada com sucesso.');
    }

    public function destroy(Promotion $promotion)
    {
        $promotion->delete();

        return redirect()
            ->route('admin.promotions.index')
            ->with('success', 'Promoção removida com sucesso.');
    }
}