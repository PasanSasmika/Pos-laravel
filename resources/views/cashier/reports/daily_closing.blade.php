<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Daily Closing Report - {{ now()->format('Y-m-d') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($sales->isEmpty())
                        <p>No sales data for today.</p>
                    @else
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-700">
                                    <th class="p-2 border">Product</th>
                                    <th class="p-2 border">Quantity</th>
                                    <th class="p-2 border">Total Amount</th>
                                    <th class="p-2 border">Discount</th>
                                    <th class="p-2 border">Tax</th>
                                    <th class="p-2 border">Payment Method</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sales as $sale)
                                    <tr>
                                        <td class="p-2 border">{{ $sale->product->name }}</td>
                                        <td class="p-2 border">{{ $sale->quantity }}</td>
                                        <td class="p-2 border">{{ number_format($sale->total_amount, 2) }}</td>
                                        <td class="p-2 border">{{ number_format($sale->discount, 2) }}</td>
                                        <td class="p-2 border">{{ number_format($sale->tax, 2) }}</td>
                                        <td class="p-2 border">{{ $sale->payment_method }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            <p>Total Sales: {{ number_format($totalSales, 2) }}</p>
                            <p>Total Discount: {{ number_format($totalDiscount, 2) }}</p>
                            <p>Total Tax: {{ number_format($totalTax, 2) }}</p>
                            <p>Cash Sales: {{ number_format($cashSales, 2) }}</p>
                        </div>
                    @endif
                    <a href="{{ route('cashier.sales.create') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">Back to Sales</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>