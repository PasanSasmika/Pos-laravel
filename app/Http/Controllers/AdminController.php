<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use DB;
use Hash;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,manag,cash',
        ]);

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => $validatedData['role'],
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'User created successfully.');
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

    public function salesSummary()
    {
        $today = now()->format('Y-m-d');
        $dailySales = Sale::whereDate('sale_date', $today)->get();
        $totalDailySales = $dailySales->sum('total_amount');

        $startOfWeek = now()->startOfWeek()->format('Y-m-d');
        $endOfWeek = now()->endOfWeek()->format('Y-m-d');
        $weeklySales = Sale::whereBetween('sale_date', [$startOfWeek, $endOfWeek])->get();
        $totalWeeklySales = $weeklySales->sum('total_amount');

        $startOfMonth = now()->startOfMonth()->format('Y-m-d');
        $endOfMonth = now()->endOfMonth()->format('Y-m-d');
        $monthlySales = Sale::whereBetween('sale_date', [$startOfMonth, $endOfMonth])->get();
        $totalMonthlySales = $monthlySales->sum('total_amount');

        $bestSellingProducts = Sale::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
                                ->groupBy('product_id')
                                ->orderByDesc('total_quantity')
                                ->with('product')
                                ->take(5)
                                ->get();

        $lowSellingProducts = Sale::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
                                ->groupBy('product_id')
                                ->orderBy('total_quantity', 'asc')
                                ->with('product')
                                ->take(5)
                                ->get();

        $revenue = Sale::sum('total_amount');
        $cost = Sale::join('products', 'sales.product_id', '=', 'products.id')
                    ->sum(DB::raw('sales.quantity * products.buying_price'));
        $profit = $revenue - $cost;

        return view('admin.reports.summary', compact(
            'totalDailySales', 'totalWeeklySales', 'totalMonthlySales',
            'bestSellingProducts', 'lowSellingProducts', 'revenue', 'profit'
        ));
    }
}