<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class CashierController extends Controller
{
    // Show the form to add a sale
    public function create()
    {
        $products = Product::all();
        return view('cashier.sales.create', compact('products'));
    }

    // Store the sale in the database and generate receipt
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'selling_price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100', // Percentage discount
            'tax' => 'nullable|numeric|min:0|max:100', // Percentage tax
            'sale_date' => 'required|date',
            'payment_method' => 'required|in:cash,card,mobile',
        ]);

        $product = Product::find($request->product_id);
        $baseAmount = $request->quantity * $request->selling_price;

        // Calculate discount and tax
        $discountPercentage = $request->input('discount', 0);
        $taxPercentage = $request->input('tax', 0);
        $discountAmount = ($baseAmount * $discountPercentage) / 100;
        $taxAmount = (($baseAmount - $discountAmount) * $taxPercentage) / 100;
        $totalAmount = $baseAmount - $discountAmount + $taxAmount;

        $sale = Sale::create([
            'cashier_id' => Auth::id(),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'selling_price' => $request->selling_price,
            'discount' => $discountAmount,
            'tax' => $taxAmount,
            'total_amount' => $totalAmount,
            'sale_date' => $request->sale_date,
            'payment_method' => $request->payment_method,
        ]);

        // Update product stock
        if ($product->quantity_in_stock >= $request->quantity) {
            $product->quantity_in_stock -= $request->quantity;
            $product->save();
        } else {
            return redirect()->back()->with('error', 'Not enough stock available.');
        }

        // Generate receipt
        $receiptData = [
            'sale' => $sale,
            'product' => $product,
            'cashier' => Auth::user(),
            'date' => now()->format('Y-m-d H:i:s'),
        ];
        $pdf = Pdf::loadView('cashier.receipts.receipt', $receiptData);

        session(['latest_sale_id' => $sale->id]);

        return redirect()->route('cashier.sales.create')
            ->with('success', 'Sale added successfully.')
            ->with('receipt', $pdf->output());
    }

    // Display daily closing report
    public function dailyClosingReport()
    {
        $today = now()->format('Y-m-d');
        $sales = Sale::whereDate('sale_date', $today)->get();
        $totalSales = $sales->sum('total_amount');
        $totalDiscount = $sales->sum('discount');
        $totalTax = $sales->sum('tax');
        $cashSales = $sales->where('payment_method', 'cash')->sum('total_amount');

        return view('cashier.reports.daily_closing', compact('sales', 'totalSales', 'totalDiscount', 'totalTax', 'cashSales'));
    }

    // Print receipt for a specific sale
    public function printReceipt($sale_id)
    {
        $sale = Sale::findOrFail($sale_id);
        $product = $sale->product;
        $receiptData = [
            'sale' => $sale,
            'product' => $product,
            'cashier' => Auth::user(),
            'date' => now()->format('Y-m-d H:i:s'),
        ];
        $pdf = Pdf::loadView('cashier.receipts.receipt', $receiptData);
        return $pdf->stream('receipt.pdf');
    }
}