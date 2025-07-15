<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Add Daily Sale
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg p-8">
                @if (session('success'))
                    <div class="mb-6 text-green-600 font-medium">{{ session('success') }}</div>
                    @if (session('receipt'))
                        <iframe
                            src="data:application/pdf;base64,{{ base64_encode(session('receipt')) }}"
                            width="100%" height="500px"
                            class="mb-4 rounded border border-gray-300"
                            style="border:none;">
                        </iframe>
                        @if (session('latest_sale_id'))
                            <a href="{{ route('cashier.receipt.print', ['sale_id' => session('latest_sale_id')]) }}"
                               target="_blank"
                               class="inline-block mb-6 bg-blue-600 hover:bg-blue-700 transition text-white px-5 py-2 rounded shadow">
                                Print Receipt
                            </a>
                        @endif
                    @endif
                @endif

                @if (session('error'))
                    <div class="mb-6 text-red-600 font-medium">{{ session('error') }}</div>
                @endif

                <form action="{{ route('cashier.sales.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="product_id" class="block text-sm font-medium mb-1">Product</label>
                        <select name="product_id" id="product_id" required
                                class="w-full rounded-md border border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">
                                    {{ $product->name }} (Stock: {{ $product->quantity_in_stock }})
                                </option>
                            @endforeach
                        </select>
                        @error('product_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="quantity" class="block text-sm font-medium mb-1">Quantity</label>
                        <input type="number" name="quantity" id="quantity" required min="1"
                               class="w-full rounded-md border border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100" />
                        @error('quantity') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="selling_price" class="block text-sm font-medium mb-1">Selling Price per Unit</label>
                        <input type="number" name="selling_price" id="selling_price" required step="0.01" min="0"
                               class="w-full rounded-md border border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100" />
                        @error('selling_price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="discount" class="block text-sm font-medium mb-1">Discount (%)</label>
                        <input type="number" name="discount" id="discount" min="0" max="100" value="0"
                               class="w-full rounded-md border border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100" />
                        @error('discount') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="tax" class="block text-sm font-medium mb-1">Tax (%)</label>
                        <input type="number" name="tax" id="tax" min="0" max="100" value="0"
                               class="w-full rounded-md border border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100" />
                        @error('tax') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="sale_date" class="block text-sm font-medium mb-1">Sale Date</label>
                        <input type="date" name="sale_date" id="sale_date" required
                               value="{{ date('Y-m-d') }}"
                               class="w-full rounded-md border border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100" />
                        @error('sale_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="payment_method" class="block text-sm font-medium mb-1">Payment Method</label>
                        <select name="payment_method" id="payment_method" required
                                class="w-full rounded-md border border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                            <option value="cash">Cash</option>
                            <option value="card">Card</option>
                            <option value="mobile">Mobile Payment</option>
                        </select>
                        @error('payment_method') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-md transition">
                        Add Sale
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
