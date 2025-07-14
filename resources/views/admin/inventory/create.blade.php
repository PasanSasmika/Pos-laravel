<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Add New Product
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.inventory.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium">Product Name</label>
                            <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md" required>
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="category" class="block text-sm font-medium">Category</label>
                            <input type="text" name="category" id="category" class="mt-1 block w-full border-gray-300 rounded-md" required>
                            @error('category') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="buying_price" class="block text-sm font-medium">Buying Price</label>
                            <input type="number" name="buying_price" id="buying_price" step="0.01" class="mt-1 block w-full border-gray-300 rounded-md" required>
                            @error('buying_price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="selling_price" class="block text-sm font-medium">Selling Price</label>
                            <input type="number" name="selling_price" id="selling_price" step="0.01" class="mt-1 block w-full border-gray-300 rounded-md" required>
                            @error('selling_price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="quantity_in_stock" class="block text-sm font-medium">Quantity in Stock</label>
                            <input type="number" name="quantity_in_stock" id="quantity_in_stock" class="mt-1 block w-full border-gray-300 rounded-md" required>
                            @error('quantity_in_stock') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="reorder_level" class="block text-sm font-medium">Reorder Level</label>
                            <input type="number" name="reorder_level" id="reorder_level" class="mt-1 block w-full border-gray-300 rounded-md" required>
                            @error('reorder_level') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="barcode" class="block text-sm font-medium">Barcode (Optional)</label>
                            <input type="text" name="barcode" id="barcode" class="mt-1 block w-full border-gray-300 rounded-md">
                            @error('barcode') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium">Product Image</label>
                            <input type="file" name="image" id="image" class="mt-1 block w-full border-gray-300 rounded-md">
                            @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>