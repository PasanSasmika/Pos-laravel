<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Sales Summary Report
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6">

                <!-- KPIs -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold">Total Revenue</h3>
                        <p class="text-3xl font-bold mt-2">Rs. {{ number_format($revenue, 2) }}</p>
                    </div>
                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold">Total Profit</h3>
                        <p class="text-3xl font-bold mt-2">Rs. {{ number_format($profit, 2) }}</p>
                    </div>
                </div>

                <!-- Sales Overview Chart -->
                <div class="mb-12">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">📊 Sales Overview</h2>
                    <canvas id="salesChart" height="100"></canvas>
                </div>

                <!-- Best-Selling Chart -->
                <div class="mb-12">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">🔥 Best-Selling Products</h2>
                    <canvas id="bestSellingChart" height="100"></canvas>
                </div>

                <!-- Low-Selling Chart -->
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">⚠️ Low-Selling Products</h2>
                    <canvas id="lowSellingChart" height="100"></canvas>
                </div>

            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Sales Chart
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        new Chart(salesCtx, {
            type: 'bar',
            data: {
                labels: ['Daily', 'Weekly', 'Monthly'],
                datasets: [{
                    label: 'Total Sales',
                    data: [{{ $totalDailySales }}, {{ $totalWeeklySales }}, {{ $totalMonthlySales }}],
                    backgroundColor: ['#3b82f6', '#10b981', '#f59e0b'],
                    borderRadius: 8,
                }]
            },
            options: {
                plugins: {
                    legend: { labels: { color: '#ffffff' } }
                },
                scales: {
                    x: { ticks: { color: '#ffffff' } },
                    y: {
                        beginAtZero: true,
                        ticks: { color: '#ffffff' }
                    }
                }
            }
        });

        // Best-Selling Products Chart
        const bestCtx = document.getElementById('bestSellingChart').getContext('2d');
        new Chart(bestCtx, {
            type: 'bar',
            data: {
                labels: [@foreach($bestSellingProducts as $product)'{{ $product->product->name }}', @endforeach],
                datasets: [{
                    label: 'Quantity Sold',
                    data: [@foreach($bestSellingProducts as $product){{ $product->total_quantity }}, @endforeach],
                    backgroundColor: '#6366f1',
                    borderRadius: 8,
                }]
            },
            options: {
                plugins: {
                    legend: { labels: { color: '#ffffff' } }
                },
                scales: {
                    x: { ticks: { color: '#ffffff' } },
                    y: {
                        beginAtZero: true,
                        ticks: { color: '#ffffff' }
                    }
                }
            }
        });

        // Low-Selling Products Chart
        const lowCtx = document.getElementById('lowSellingChart').getContext('2d');
        new Chart(lowCtx, {
            type: 'bar',
            data: {
                labels: [@foreach($lowSellingProducts as $product)'{{ $product->product->name }}', @endforeach],
                datasets: [{
                    label: 'Quantity Sold',
                    data: [@foreach($lowSellingProducts as $product){{ $product->total_quantity }}, @endforeach],
                    backgroundColor: '#f87171',
                    borderRadius: 8,
                }]
            },
            options: {
                plugins: {
                    legend: { labels: { color: '#ffffff' } }
                },
                scales: {
                    x: { ticks: { color: '#ffffff' } },
                    y: {
                        beginAtZero: true,
                        ticks: { color: '#ffffff' }
                    }
                }
            }
        });
    });
</script>
</x-app-layout>