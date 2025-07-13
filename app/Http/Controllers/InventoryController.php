<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class InventoryController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('role:admin');
    // }

    // Display all products
    public function index(): View
    {
        $products = Product::all();
        return view('admin.inventory.index', compact('products'));
    }

    // Show the form to create a new product
    public function create(): View
    {
        return view('admin.inventory.create');
    }

    // Store a new product in the database
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'buying_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'quantity_in_stock' => 'required|integer|min:0',
            'reorder_level' => 'required|integer|min:0',
            'barcode' => 'nullable|string|max:255',
        ]);

        $product = Product::create($request->all());

        // Generate barcode if not provided
        if (!$request->filled('barcode')) {
            $product->barcode = 'BAR' . str_pad($product->id, 10, '0', STR_PAD_LEFT);
            $product->save();
        }

        return redirect()->route('admin.inventory.index')
            ->with('success', 'Product added successfully.');
    }

    // Show the form to edit a product
    public function edit(Product $product): View
    {
        return view('admin.inventory.edit', compact('product'));
    }

    // Update an existing product
    public function update(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'buying_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'quantity_in_stock' => 'required|integer|min:0',
            'reorder_level' => 'required|integer|min:0',
            'barcode' => 'nullable|string|max:255',
        ]);

        $product->update($request->all());
        return redirect()->route('admin.inventory.index')
            ->with('success', 'Product updated successfully.');
    }

    // Delete a product
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect()->route('admin.inventory.index')
            ->with('success', 'Product deleted successfully.');
    }
}