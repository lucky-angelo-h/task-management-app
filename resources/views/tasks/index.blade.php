<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('Task List') }}
      </h2>
  </x-slot>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <!-- <a href="" class="">
          Create Task
      </a> -->
      <x-button-link :href="route('tasks.create')">
          {{ __('Create Task') }}
      </x-button-link>
      <table class="min-w-full bg-white shadow-md rounded mb-4">
          <thead>
              <tr class="bg-gray-200 text-gray-700">
                  <th class="text-left py-2 px-4">ID</th>
                  <th class="text-left py-2 px-4">Task Name</th>
                  <th class="text-left py-2 px-4">Category</th>
                  <th class="text-left py-2 px-4">Status</th>
                  <th class="text-left py-2 px-4">Completion Date</th>
                  <th class="text-left py-2 px-4">Actions</th>
              </tr>
          </thead>
          <tbody>
              @forelse ($tasks as $task)
              <tr class="border-t">
                  <td class="py-2 px-4">{{ $task->id }}</td>
                  <td class="py-2 px-4">{{ $task->task_name }}</td>
                  <td class="py-2 px-4">{{ $task->category->category_name ?? 'No Category' }}</td>
                  <td class="py-2 px-4">{{ $task->status->status_name }}</td>
                  <td class="py-2 px-4">{{ $task->completion_date ? $task->completion_date : '--' }}</td>
                  <td class="py-2 px-4">
                      <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-600 hover:underline">Edit</a>
                      <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline-block">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="text-red-600 hover:underline ml-2">Delete</button>
                      </form>
                  </td>
              </tr>
              @empty
              <tr>
                  <td colspan="6" class="text-center py-4">No tasks available.</td>
              </tr>
              @endforelse
          </tbody>
      </table>

      <!-- Pagination Links -->
      <div class="mt-4">
          {{ $tasks->links() }}
      </div>
    </div>
  </div>
</x-app-layout>