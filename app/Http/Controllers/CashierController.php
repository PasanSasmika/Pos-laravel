<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashierController extends Controller
{
    // Show the form to add a sale
   public function create()
{
    $products = Product::all();
    return view('cashier.sales.create', compact('products'));
}

    // Store the sale in the database
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'selling_price' => 'required|numeric|min:0',
            'sale_date' => 'required|date',
            'payment_method' => 'required|in:cash,card,mobile',
        ]);

        $totalAmount = $request->quantity * $request->selling_price;

        Sale::create([
            'cashier_id' => Auth::id(), // Current logged-in cashier
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'selling_price' => $request->selling_price,
            'total_amount' => $totalAmount,
            'sale_date' => $request->sale_date,
            'payment_method' => $request->payment_method,
        ]);

        // Optional: Update product stock
        $product = Product::find($request->product_id);
        if ($product->stock >= $request->quantity) {
            $product->stock -= $request->quantity;
            $product->save();
        } else {
            return redirect()->back()->with('error', 'Not enough stock available.');
        }

        return redirect()->route('cashier.sales.create')->with('success', 'Sale added successfully.');
    }
}
