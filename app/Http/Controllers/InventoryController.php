<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Picqer\Barcode\BarcodeGeneratorPNG;

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
            'barcode' => 'nullable|string|max:255|unique:products,barcode',
            'image' => 'nullable|image|max:2048', // Validate image upload (max 2MB)
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $data['image'] = $imagePath;
        }

        $product = Product::create($data);

        // Generate barcode if not provided
        if (!$request->filled('barcode')) {
            $product->barcode = 'P' . str_pad($product->id, 11, '0', STR_PAD_LEFT);
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
            'barcode' => 'nullable|string|max:255|unique:products,barcode,' . $product->id,
            'image' => 'nullable|image|max:2048', // Validate image upload (max 2MB)
        ]);

        $data = $request->all();

        // Handle image upload or update
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($product->image) {
                \Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
            $data['image'] = $imagePath;
        }

        $product->update($data);
        return redirect()->route('admin.inventory.index')
            ->with('success', 'Product updated successfully.');
    }

    // Delete a product
    public function destroy(Product $product): RedirectResponse
    {
        // Delete the image if it exists
        if ($product->image) {
            \Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('admin.inventory.index')
            ->with('success', 'Product deleted successfully.');
    }

    // Generate barcode image for a product
    public function barcode(Product $product)
    {
        $generator = new BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode($product->barcode, $generator::TYPE_CODE_128);
        return response($barcode)->header('Content-Type', 'image/png');
    }
}