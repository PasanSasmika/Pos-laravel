<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Product
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl overflow-hidden">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.inventory.update', $product) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium mb-1">Name</label>
                                <input type="text" name="name" value="{{ $product->name }}" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white rounded-lg p-2" required />
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-1">Category</label>
                                <input type="text" name="category" value="{{ $product->category }}" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white rounded-lg p-2" required />
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-1">Buying Price</label>
                                <input type="number" name="buying_price" value="{{ $product->buying_price }}" step="0.01" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white rounded-lg p-2" required />
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-1">Selling Price</label>
                                <input type="number" name="selling_price" value="{{ $product->selling_price }}" step="0.01" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white rounded-lg p-2" required />
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-1">Quantity in Stock</label>
                                <input type="number" name="quantity_in_stock" value="{{ $product->quantity_in_stock }}" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white rounded-lg p-2" required />
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-1">Reorder Level</label>
                                <input type="number" name="reorder_level" value="{{ $product->reorder_level }}" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white rounded-lg p-2" required />
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium mb-1">Barcode</label>
                                <input type="text" name="barcode" value="{{ $product->barcode }}" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white rounded-lg p-2" />
                                @if ($product->barcode)
                                    <img src="{{ route('admin.inventory.barcode', $product) }}" alt="Barcode" class="mt-2 h-10">
                                @endif
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium mb-1">Product Image</label>
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image" class="mt-2 h-20 mb-2 rounded-md shadow">
                                @endif
                                <input type="file" name="image" id="image" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 text-white rounded-lg p-2">
                                @error('image') 
                                    <span class="text-red-500 text-sm">{{ $message }}</span> 
                                @enderror
                            </div>
                        </div>

                        <div class="mt-8">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md shadow transition">
                                Update Product
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
