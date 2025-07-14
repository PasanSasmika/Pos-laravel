<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Hi Manager
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('manager.reports.daily') }}" class="mt-4 inline-block bg-green-500 text-white px-4 py-2 rounded">Daily Sales Report</a>
                    <a href="{{ route('manager.reports.weekly') }}" class="mt-4 inline-block bg-green-500 text-white px-4 py-2 rounded ml-2">Weekly Sales Report</a>
                    <a href="{{ route('manager.reports.monthly') }}" class="mt-4 inline-block bg-green-500 text-white px-4 py-2 rounded ml-2">Monthly Sales Report</a>
                    <a href="{{ route('manager.reports.best_selling') }}" class="mt-4 inline-block bg-green-500 text-white px-4 py-2 rounded ml-2">Best Selling Products</a>
                    <a href="{{ route('manager.reports.low_selling') }}" class="mt-4 inline-block bg-green-500 text-white px-4 py-2 rounded ml-2">Low Selling Products</a>
                    <a href="{{ route('manager.reports.revenue_profit') }}" class="mt-4 inline-block bg-green-500 text-white px-4 py-2 rounded ml-2">Revenue and Profit</a>
                </div>
            </div>

            <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('manager.reports.summary') }}" class="mt-4 inline-block bg-green-500 text-white px-4 py-2 rounded">Sales Summary Report</a>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>
</x-app-layout>