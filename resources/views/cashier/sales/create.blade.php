<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Add Daily Sale
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="mb-4 text-green-600">{{ session('success') }}</div>
                        @if (session('receipt'))
                            <iframe src="data:application/pdf;base64,{{ base64_encode(session('receipt')) }}" width="100%" height="500px" style="border: none;"></iframe>
                            @if (session('latest_sale_id'))
                                <a href="{{ route('cashier.receipt.print', ['sale_id' => session('latest_sale_id')]) }}" target="_blank" class="mt-2 inline-block bg-blue-500 text-white px-4 py-2 rounded">Print Receipt</a>
                            @endif
                        @endif
                    @endif
                    @if (session('error'))
                        <div class="mb-4 text-red-600">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('cashier.sales.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="product_id" class="block text-sm font-medium">Product</label>
                            <select name="product_id" id="product_id" class="mt-1 block w-full border-gray-300 rounded-md" required>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }} (Stock: {{ $product->quantity_in_stock }})</option>
                                @endforeach
                            </select>
                            @error('product_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="quantity" class="block text-sm font-medium">Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="mt-1 block w-full border-gray-300 rounded-md" required min="1">
                            @error('quantity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="selling_price" class="block text-sm font-medium">Selling Price per Unit</label>
                            <input type="number" name="selling_price" id="selling_price" class="mt-1 block w-full border-gray-300 rounded-md" required step="0.01" min="0">
                            @error('selling_price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="discount" class="block text-sm font-medium">Discount (%)</label>
                            <input type="number" name="discount" id="discount" class="mt-1 block w-full border-gray-300 rounded-md" min="0" max="100" value="0">
                            @error('discount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="tax" class="block text-sm font-medium">Tax (%)</label>
                            <input type="number" name="tax" id="tax" class="mt-1 block w-full border-gray-300 rounded-md" min="0" max="100" value="0">
                            @error('tax') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="sale_date" class="block text-sm font-medium">Sale Date</label>
                            <input type="date" name="sale_date" id="sale_date" class="mt-1 block w-full border-gray-300 rounded-md" required value="{{ date('Y-m-d') }}">
                            @error('sale_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="payment_method" class="block text-sm font-medium">Payment Method</label>
                            <select name="payment_method" id="payment_method" class="mt-1 block w-full border-gray-300 rounded-md" required>
                                <option value="cash">Cash</option>
                                <option value="card">Card</option>
                                <option value="mobile">Mobile Payment</option>
                            </select>
                            @error('payment_method') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Sale</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>