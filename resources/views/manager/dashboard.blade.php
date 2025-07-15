<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Hi Manager
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">

                <div class="flex flex-wrap gap-4 justify-center">
                    <a href="{{ route('manager.reports.daily') }}" class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded shadow text-center whitespace-nowrap">
                        Daily Sales Report
                    </a>
                    <a href="{{ route('manager.reports.weekly') }}" class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded shadow text-center whitespace-nowrap">
                        Weekly Sales Report
                    </a>
                    <a href="{{ route('manager.reports.monthly') }}" class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded shadow text-center whitespace-nowrap">
                        Monthly Sales Report
                    </a>
                    <a href="{{ route('manager.reports.best_selling') }}" class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded shadow text-center whitespace-nowrap">
                        Best Selling Products
                    </a>
                    <a href="{{ route('manager.reports.low_selling') }}" class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded shadow text-center whitespace-nowrap">
                        Low Selling Products
                    </a>
                    <a href="{{ route('manager.reports.revenue_profit') }}" class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded shadow text-center whitespace-nowrap">
                        Revenue and Profit
                    </a>
                    <a href="{{ route('manager.reports.summary') }}" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded shadow text-center whitespace-nowrap">
                        Sales Summary Report
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
