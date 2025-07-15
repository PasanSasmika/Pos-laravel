<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Welcome, Admin
        </h2>
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
