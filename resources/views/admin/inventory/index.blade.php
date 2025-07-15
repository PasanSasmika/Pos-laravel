<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Inventory Management
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-x-auto">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if (session('success'))
                        <div class="mb-6 p-4 bg-green-100 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <a href="{{ route('admin.inventory.create') }}"
                       class="inline-block mb-6 bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2 rounded">
                        + Add New Product
                    </a>

                    <table class="w-full table-auto border-collapse border border-gray-200 dark:border-gray-700 text-sm">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                                <th class="border border-gray-200 dark:border-gray-600 p-2 text-left">Name</th>
                                <th class="border border-gray-200 dark:border-gray-600 p-2 text-left">Category</th>
                                <th class="border border-gray-200 dark:border-gray-600 p-2 text-left">Buying Price</th>
                                <th class="border border-gray-200 dark:border-gray-600 p-2 text-left">Selling Price</th>
                                <th class="border border-gray-200 dark:border-gray-600 p-2 text-left">Stock</th>
                                <th class="border border-gray-200 dark:border-gray-600 p-2 text-left">Reorder Level</th>
                                <th class="border border-gray-200 dark:border-gray-600 p-2 text-left">Barcode</th>
                                <th class="border border-gray-200 dark:border-gray-600 p-2 text-left">Image</th>
                                <th class="border border-gray-200 dark:border-gray-600 p-2 text-left">Barcode Image</th>
                                <th class="border border-gray-200 dark:border-gray-600 p-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($products as $product)
                                <tr>
                                    <td class="border border-gray-200 dark:border-gray-700 p-2">{{ $product->name }}</td>
                                    <td class="border border-gray-200 dark:border-gray-700 p-2">{{ $product->category }}</td>
                                    <td class="border border-gray-200 dark:border-gray-700 p-2">Rs. {{ number_format($product->buying_price, 2) }}</td>
                                    <td class="border border-gray-200 dark:border-gray-700 p-2">Rs. {{ number_format($product->selling_price, 2) }}</td>
                                    <td class="border border-gray-200 dark:border-gray-700 p-2">{{ $product->quantity_in_stock }}</td>
                                    <td class="border border-gray-200 dark:border-gray-700 p-2">{{ $product->reorder_level }}</td>
                                    <td class="border border-gray-200 dark:border-gray-700 p-2">{{ $product->barcode ?? 'N/A' }}</td>
                                    <td class="border border-gray-200 dark:border-gray-700 p-2">
                                        @if ($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="h-6 w-6 object-cover rounded">
                                        @else
                                            <span class="text-gray-400 italic">No Image</span>
                                        @endif
                                    </td>
                                    <td class="border border-gray-200 dark:border-gray-700 p-2">
                                        <img src="{{ route('admin.inventory.barcode', $product) }}" alt="Barcode" class="h-6" />
                                    </td>
                                    <td class="border border-gray-200 dark:border-gray-700 p-2 whitespace-nowrap">
                                        <a href="{{ route('admin.inventory.edit', $product) }}" class="text-blue-600 hover:underline">Edit</a>
                                        <form action="{{ route('admin.inventory.destroy', $product) }}" method="POST" class="inline ml-3" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
