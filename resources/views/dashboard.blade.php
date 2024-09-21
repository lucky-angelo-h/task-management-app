<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Task Statistics by Status -->
            <div class="mb-8">
                <h3 class="text-2xl font-semibold text-white mb-4">Tasks by Status</h3>
                <table class="min-w-full bg-white shadow-md rounded mb-4">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="text-left py-2 px-4">Status</th>
                            <th class="text-left py-2 px-4">Task Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tasksPerStatus as $status)
                            <tr class="border-t">
                                <td class="py-2 px-4">{{ $status->status_name }}</td>
                                <td class="py-2 px-4">{{ $status->tasks_count }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center py-4">No tasks found for any status.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Task Statistics by Category -->
            <div>
                <h3 class="text-2xl font-semibold text-white mb-4">Tasks by Category</h3>
                <table class="min-w-full bg-white shadow-md rounded mb-4">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="text-left py-2 px-4">Category</th>
                            <th class="text-left py-2 px-4">Task Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tasksPerCategory as $category)
                            <tr class="border-t">
                                <td class="py-2 px-4">{{ $category->category_name }}</td>
                                <td class="py-2 px-4">{{ $category->tasks_count }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center py-4">No tasks found for any category.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

