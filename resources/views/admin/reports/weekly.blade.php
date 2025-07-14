<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            weekly Sales Report
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($sales->isEmpty())
                        <p>No sales data for this week.</p>
                    @else
                        <p>Total Sales: {{ number_format($totalSales, 2) }}</p>
                        <table class="w-full mt-4 border-collapse">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-700">
                                    <th class="p-2 border">Product</th>
                                    <th class="p-2 border">Quantity</th>
                                    <th class="p-2 border">Selling Price</th>
                                    <th class="p-2 border">Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sales as $sale)
                                    <tr>
                                        <td class="p-2 border">{{ $sale->product->name }}</td>
                                        <td class="p-2 border">{{ $sale->quantity }}</td>
                                        <td class="p-2 border">{{ number_format($sale->selling_price, 2) }}</td>
                                        <td class="p-2 border">{{ number_format($sale->total_amount, 2) }}</td>
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