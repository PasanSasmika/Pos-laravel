<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function dailySales()
{
    $today = now()->format('Y-m-d');
    $sales = Sale::whereDate('sale_date', $today)->get();
    $totalSales = $sales->sum('total_amount');
    return view('admin.reports.daily', compact('sales', 'totalSales'));
}

public function weeklySales()
{
    $startOfWeek = now()->startOfWeek()->format('Y-m-d');
    $endOfWeek = now()->endOfWeek()->format('Y-m-d');
    $sales = Sale::whereBetween('sale_date', [$startOfWeek, $endOfWeek])->get();
    $totalSales = $sales->sum('total_amount');
    return view('admin.reports.weekly', compact('sales', 'totalSales'));
}

public function monthlySales()
{
    $startOfMonth = now()->startOfMonth()->format('Y-m-d');
    $endOfMonth = now()->endOfMonth()->format('Y-m-d');
    $sales = Sale::whereBetween('sale_date', [$startOfMonth, $endOfMonth])->get();
    $totalSales = $sales->sum('total_amount');
    return view('admin.reports.monthly', compact('sales', 'totalSales'));
}

public function bestSellingProducts()
{
    $products = Sale::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
                    ->groupBy('product_id')
                    ->orderByDesc('total_quantity')
                    ->with('product')
                    ->get();
    return view('admin.reports.best_selling', compact('products'));
}

public function lowSellingProducts()
{
    $products = Sale::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
                    ->groupBy('product_id')
                    ->orderBy('total_quantity', 'asc')
                    ->with('product')
                    ->get();
    return view('admin.reports.low_selling', compact('products'));
}

public function revenueProfit()
{
    $revenue = Sale::sum('total_amount');
    $cost = Sale::join('products', 'sales.product_id', '=', 'products.id')
                ->sum(DB::raw('sales.quantity * products.buying_price'));
    $profit = $revenue - $cost;
    return view('admin.reports.revenue_profit', compact('revenue', 'profit'));
}
}


