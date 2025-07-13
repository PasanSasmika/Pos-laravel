<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           Hi Admin...!
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <a href="{{ route('admin.inventory.index') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">Manage Inventory</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
