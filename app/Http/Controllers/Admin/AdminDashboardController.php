<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalPromotions = Promotion::count();

        $monthRevenue = Order::whereMonth(
            'created_at',
            Carbon::now()->month
        )->sum('total');

        $totalSold = OrderItem::sum('quantity');

        $latestOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        $topProducts = OrderItem::select(
            'product_id',
            DB::raw('SUM(quantity) as total')
        )
            ->with('product')
            ->groupBy('product_id')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        $salesChart = Order::selectRaw(
            'DATE(created_at) as date,
                 SUM(total) as total'
        )
            ->whereDate(
                'created_at',
                '>=',
                now()->subDays(7)
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalPromotions',
            'monthRevenue',
            'totalSold',
            'latestOrders',
            'topProducts',
            'salesChart'
        ));
    }
}
