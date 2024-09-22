<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('Tasks') }}
      </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <!-- Create Task Button -->
      <x-button-link :href="route('tasks.create')">
          {{ __('Create Task') }}
      </x-button-link>

      <!-- Task List by Status -->
      <div class="grid grid-cols-1 md:grid-cols-{{ $statuses->count() }} gap-4">
        @foreach ($statuses as $status)
        <div class="bg-white shadow-md rounded p-4">
            <h3 class="text-lg font-bold text-gray-800">{{ $status->status_name }}</h3>
            <table class="min-w-full bg-white mt-4">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="text-left py-2 px-4">Task Name</th>
                        <th class="text-left py-2 px-4">Category</th>
                        <th class="text-left py-2 px-4">Completion Date</th>
                        <th class="text-left py-2 px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($status->tasks as $task)
                    <tr class="border-t">
                        <td class="py-2 px-4">{{ $task->task_name }}</td>
                        <td class="py-2 px-4">{{ $task->category->category_name ?? 'No Category' }}</td>
                        <td class="py-2 px-4">{{ $task->completion_date ? $task->completion_date : '--' }}</td>
                        <td class="py-2 px-4">
                            <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline ml-2">Delete</button>
                            </form>

                            @php
                                // Determine if there's a next status
                                $nextStatus = $statuses->firstWhere('id', '>', $task->status_id);
                            @endphp

                            @if ($nextStatus)
                            <form action="{{ route('tasks.update-status', $task->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status_id" value="{{ $nextStatus->id }}">
                                <button type="submit" class="text-green-600 hover:underline ml-2">
                                    {{ __('Move to') }} {{ $nextStatus->status_name }}
                                </button>
                            </form>
                            @else
                            <!-- If there's no next status, display a message -->
                            <span class="text-gray-500 ml-2">{{ __('No further status') }}</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4">No tasks available in this status.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</x-app-layout>