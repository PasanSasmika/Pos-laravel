<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                Welcome, Admin
            </h2>
            
            <!-- Notification Button -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="p-2 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-full relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    
                    @if($lowStockProducts->count() > 0)
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                            {{ $lowStockProducts->count() }}
                        </span>
                    @endif
                </button>

                <!-- Notification Dropdown -->
                <div x-show="open" @click.away="open = false" 
                    class="absolute right-0 mt-2 w-80 bg-white dark:bg-yellow-800 rounded-md shadow-lg overflow-hidden z-20 border border-gray-200 dark:border-gray-700">
                    <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="font-medium text-gray-900 dark:text-white">Low Stock Alerts</h3>
                    </div>
                    
                    <div class="max-h-96 overflow-y-auto">
                        @forelse($lowStockProducts as $product)
                            <a href="{{ route('admin.inventory.edit', $product) }}" 
                                class="block px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700 border-b border-gray-100 dark:border-gray-700">
                                <div class="flex justify-between">
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-white truncate">{{ $product->name }}</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                            Stock: {{ $product->quantity_in_stock }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="px-4 py-8 text-center">
                                <p class="text-gray-500 dark:text-gray-400">No low stock items</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Inventory Management -->
                <div class="bg-slate-800 rounded-xl shadow-lg p-6 hover:ring-2 hover:ring-blue-400 transition">
                    <h3 class="text-white font-semibold text-lg mb-4">Inventory</h3>
                    <a href="{{ route('admin.inventory.index') }}"
                       class="block bg-blue-500 hover:bg-blue-600 text-white font-medium text-center px-4 py-2 rounded-md transition">
                        Manage Inventory
                    </a>
                </div>

                <!-- User Management -->
                <div class="bg-slate-800 rounded-xl shadow-lg p-6 hover:ring-2 hover:ring-violet-400 transition">
                    <h3 class="text-white font-semibold text-lg mb-4">User Management</h3>
                    <a href="{{ route('admin.users.create') }}"
                       class="block bg-violet-500 hover:bg-violet-600 text-white font-medium text-center px-4 py-2 rounded-md transition">
                        Add New User
                    </a>
                </div>

                <!-- Sales Reports -->
                <div class="bg-slate-800 rounded-xl shadow-lg p-6 hover:ring-2 hover:ring-green-400 transition">
                    <h3 class="text-white font-semibold text-lg mb-4">Sales Reports</h3>
                    <div class="space-y-2">
                        <a href="{{ route('admin.reports.daily') }}" class="block bg-green-500 hover:bg-green-600 text-white text-center px-4 py-2 rounded-md transition">Daily</a>
                        <a href="{{ route('admin.reports.weekly') }}" class="block bg-green-500 hover:bg-green-600 text-white text-center px-4 py-2 rounded-md transition">Weekly</a>
                        <a href="{{ route('admin.reports.monthly') }}" class="block bg-green-500 hover:bg-green-600 text-white text-center px-4 py-2 rounded-md transition">Monthly</a>
                    </div>
                </div>

                <!-- Product Performance -->
                <div class="bg-slate-800 rounded-xl shadow-lg p-6 hover:ring-2 hover:ring-pink-400 transition">
                    <h3 class="text-white font-semibold text-lg mb-4">Product Performance</h3>
                    <div class="space-y-2">
                        <a href="{{ route('admin.reports.best_selling') }}" class="block bg-pink-500 hover:bg-pink-600 text-white text-center px-4 py-2 rounded-md transition">Best Selling</a>
                        <a href="{{ route('admin.reports.low_selling') }}" class="block bg-pink-500 hover:bg-pink-600 text-white text-center px-4 py-2 rounded-md transition">Low Selling</a>
                    </div>
                </div>

                <!-- Financial Reports -->
                <div class="bg-slate-800 rounded-xl shadow-lg p-6 hover:ring-2 hover:ring-indigo-400 transition">
                    <h3 class="text-white font-semibold text-lg mb-4">Financial Reports</h3>
                    <a href="{{ route('admin.reports.revenue_profit') }}" class="block bg-indigo-500 hover:bg-indigo-600 text-white text-center px-4 py-2 rounded-md transition">Revenue & Profit</a>
                    <a href="{{ route('admin.reports.summary') }}" class="block mt-2 bg-indigo-500 hover:bg-indigo-600 text-white text-center px-4 py-2 rounded-md transition">Sales Summary</a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>