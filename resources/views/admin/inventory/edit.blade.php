<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Product
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.inventory.update', $product) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="block text-sm font-medium">Name</label>
                            <input type="text" name="name" value="{{ $product->name }}" class="w-full border rounded p-2" required />
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium">Category</label>
                            <input type="text" name="category" value="{{ $product->category }}" class="w-full border rounded p-2" required />
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium">Buying Price</label>
                            <input type="number" name="buying_price" value="{{ $product->buying_price }}" step="0.01" class="w-full border rounded p-2" required />
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium">Selling Price</label>
                            <input type="number" name="selling_price" value="{{ $product->selling_price }}" step="0.01" class="w-full border rounded p-2" required />
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium">Quantity in Stock</label>
                            <input type="number" name="quantity_in_stock" value="{{ $product->quantity_in_stock }}" class="w-full border rounded p-2" required />
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium">Reorder Level</label>
                            <input type="number" name="reorder_level" value="{{ $product->reorder_level }}" class="w-full border rounded p-2" required />
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium">Barcode</label>
                            <input type="text" name="barcode" value="{{ $product->barcode }}" class="w-full border rounded p-2" />
                            @if ($product->barcode)
                                <img src="{{ route('admin.inventory.barcode', $product) }}" alt="Barcode" class="mt-2 h-10" />
                            @endif
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium">Product Image</label>
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image" class="mt-2 h-20 mb-2">
                            @endif
                            <input type="file" name="image" id="image" class="mt-1 block w-full border-gray-300 rounded-md">
                            @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>