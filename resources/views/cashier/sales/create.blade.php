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
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('cashier.sales.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="product_id">Product</label>
                            <select name="product_id" id="product_id" required>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }} (Stock: {{ $product->stock }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" id="quantity" required min="1">
                        </div>
                        <div>
                            <label for="selling_price">Selling Price per Unit</label>
                            <input type="number" name="selling_price" id="selling_price" required step="0.01" min="0">
                        </div>
                        <div>
                            <label for="sale_date">Sale Date</label>
                            <input type="date" name="sale_date" id="sale_date" required value="{{ date('Y-m-d') }}">
                        </div>
                        <div>
                            <label for="payment_method">Payment Method</label>
                            <select name="payment_method" id="payment_method" required>
                                <option value="cash">Cash</option>
                                <option value="card">Card</option>
                                <option value="mobile">Mobile Payment</option>
                            </select>
                        </div>
                        <button type="submit">Add Sale</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>