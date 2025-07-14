<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Sales Summary Report
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- KPIs -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                        <div class="bg-white p-4 rounded shadow">
                            <h3 class="text-lg font-semibold">Total Revenue</h3>
                            <p class="text-2xl">{{ number_format($revenue, 2) }}</p>
                        </div>
                        <div class="bg-white p-4 rounded shadow">
                            <h3 class="text-lg font-semibold">Total Profit</h3>
                            <p class="text-2xl">{{ number_format($profit, 2) }}</p>
                        </div>
                    </div>

                    <!-- Sales Chart -->
                    <div class="mt-8">
                        <h2 class="text-xl font-semibold">Sales Overview</h2>
                        <canvas id="salesChart" width="400" height="200"></canvas>
                    </div>

                    <!-- Best-Selling Products Chart -->
                    <div class="mt-8">
                        <h2 class="text-xl font-semibold">Best-Selling Products</h2>
                        <canvas id="bestSellingChart" width="400" height="200"></canvas>
                    </div>

                    <!-- Low-Selling Products Chart -->
                    <div class="mt-8">
                        <h2 class="text-xl font-semibold">Low-Selling Products</h2>
                        <canvas id="lowSellingChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Sales Chart
            var salesCtx = document.getElementById('salesChart').getContext('2d');
            var salesChart = new Chart(salesCtx, {
                type: 'bar',
                data: {
                    labels: ['Daily', 'Weekly', 'Monthly'],
                    datasets: [{
                        label: 'Total Sales',
                        data: [{{ $totalDailySales }}, {{ $totalWeeklySales }}, {{ $totalMonthlySales }}],
                        backgroundColor: ['#3490dc', '#38a169', '#f6ad55']
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Best-Selling Products Chart
            var bestSellingCtx = document.getElementById('bestSellingChart').getContext('2d');
            var bestSellingChart = new Chart(bestSellingCtx, {
                type: 'bar',
                data: {
                    labels: [@foreach($bestSellingProducts as $product)'{{ $product->product->name }}', @endforeach],
                    datasets: [{
                        label: 'Quantity Sold',
                        data: [@foreach($bestSellingProducts as $product){{ $product->total_quantity }}, @endforeach],
                        backgroundColor: '#3490dc'
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Low-Selling Products Chart
            var lowSellingCtx = document.getElementById('lowSellingChart').getContext('2d');
            var lowSellingChart = new Chart(lowSellingCtx, {
                type: 'bar',
                data: {
                    labels: [@foreach($lowSellingProducts as $product)'{{ $product->product->name }}', @endforeach],
                    datasets: [{
                        label: 'Quantity Sold',
                        data: [@foreach($lowSellingProducts as $product){{ $product->total_quantity }}, @endforeach],
                        backgroundColor: '#e3342f'
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>