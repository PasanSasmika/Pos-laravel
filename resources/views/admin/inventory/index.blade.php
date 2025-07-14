<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Inventory Management
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="mb-4 text-green-600">{{ session('success') }}</div>
                    @endif
                    <a href="{{ route('admin.inventory.create') }}" class="mb-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">Add New Product</a>
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-700">
                                <th class="p-2">Name</th>
                                <th class="p-2">Category</th>
                                <th class="p-2">Buying Price</th>
                                <th class="p-2">Selling Price</th>
                                <th class="p-2">Stock</th>
                                <th class="p-2">Reorder Level</th>
                                <th class="p-2">Barcode</th>
                                <th class="p-2">Image</th>
                                <th class="p-2">Barcode Image</th>
                                <th class="p-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td class="p-2">{{ $product->name }}</td>
                                    <td class="p-2">{{ $product->category }}</td>
                                    <td class="p-2">{{ $product->buying_price }}</td>
                                    <td class="p-2">{{ $product->selling_price }}</td>
                                    <td class="p-2">{{ $product->quantity_in_stock }}</td>
                                    <td class="p-2">{{ $product->reorder_level }}</td>
                                    <td class="p-2">{{ $product->barcode ?? 'N/A' }}</td>
                                    <td class="p-2">
                                        @if ($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="h-10">
                                        @else
                                            <span>No Image</span>
                                        @endif
                                    </td>
                                    <td class="p-2">
                                        <img src="{{ route('admin.inventory.barcode', $product) }}" alt="Barcode" class="h-10" />
                                    </td>
                                    <td class="p-2">
                                        <a href="{{ route('admin.inventory.edit', $product) }}" class="text-blue-500 hover:underline">Edit</a>
                                        <form action="{{ route('admin.inventory.destroy', $product) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline ml-2" onclick="return confirm('Are you sure?')">Delete</button>
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