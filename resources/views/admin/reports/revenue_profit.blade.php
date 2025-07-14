<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Revenue and Profit
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p>Total Revenue: {{ number_format($revenue, 2) }}</p>
                    <p>Total Profit: {{ number_format($profit, 2) }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>