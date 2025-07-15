<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Revenue and Profit
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-8">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Revenue Card -->
                    <div class="bg-gradient-to-r from-indigo-500 to-indigo-700 text-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold">Total Revenue</h3>
                        <p class="text-3xl font-bold mt-2">Rs. {{ number_format($revenue, 2) }}</p>
                    </div>

                    <!-- Profit Card -->
                    <div class="bg-gradient-to-r from-emerald-500 to-emerald-700 text-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold">Total Profit</h3>
                        <p class="text-3xl font-bold mt-2">Rs. {{ number_format($profit, 2) }}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
