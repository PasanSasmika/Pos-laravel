<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-200">
                    {{ __("Welcome..!") }}
                    <div class="mt-4 space-y-2">
                        <a href="{{ route('cashier.sales.create') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded">Add New Sale</a>
                        <a href="{{ route('cashier.daily.closing') }}" class="inline-block bg-yellow-500 text-white px-4 py-2 rounded">View Daily Closing Report</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>