<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Best-Selling Products
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($products->isEmpty())
                        <p>No sales data available.</p>
                    @else
                        <table class="w-full mt-4 border-collapse">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-700">
                                    <th class="p-2 border">Product</th>
                                    <th class="p-2 border">Total Quantity Sold</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td class="p-2 border">{{ $product->product->name }}</td>
                                        <td class="p-2 border">{{ $product->total_quantity }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>