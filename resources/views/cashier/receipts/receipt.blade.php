<!DOCTYPE html>
<html>
<head>
    <title>Sale Receipt</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .receipt { width: 300px; margin: 20px auto; padding: 20px; border: 1px solid #ccc; }
        .header { text-align: center; }
        .details { margin-top: 20px; }
        .total { font-weight: bold; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="header">
            <h2>Receipt</h2>
            <p>Date: {{ $date }}</p>
            <p>Cashier: {{ $cashier->name }}</p>
        </div>
        <div class="details">
            <p>Product: {{ $product->name }}</p>
            <p>Quantity: {{ $sale->quantity }}</p>
            <p>Selling Price: {{ number_format($sale->selling_price, 2) }}</p>
            <p>Discount: {{ number_format($sale->discount, 2) }}</p>
            <p>Tax: {{ number_format($sale->tax, 2) }}</p>
            <p class="total">Total Amount: {{ number_format($sale->total_amount, 2) }}</p>
            <p>Payment Method: {{ $sale->payment_method }}</p>
        </div>
    </div>
</body>
</html>