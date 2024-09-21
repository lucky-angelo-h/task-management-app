<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('Edit Task') }}
      </h2>
  </x-slot>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

      <form method="POST" action="{{ route('tasks.update', $task->id) }}">
          @csrf
          @method('PUT')

          <!-- Task Name -->
          <div class="mb-4">
              <label for="task_name" class="block text-gray-700">Task Name</label>
              <input type="text" name="task_name" id="task_name" value="{{ old('task_name', $task->task_name) }}" class="border rounded w-full py-2 px-3 text-gray-700 @error('task_name') border-red-500 @enderror" required>
              @error('task_name')
                  <p class="text-red-500 text-xs italic">{{ $message }}</p>
              @enderror
          </div>

          <!-- Task Description -->
          <div class="mb-4">
              <label for="task_description" class="block text-gray-700">Task Description</label>
              <input type="text" name="task_description" id="task_description" value="{{ old('task_description', $task->task_description) }}" class="border rounded w-full py-2 px-3 text-gray-700 @error('task_description') border-red-500 @enderror" required>
              @error('task_description')
                  <p class="text-red-500 text-xs italic">{{ $message }}</p>
              @enderror
          </div>

          <!-- Category Dropdown -->
          <div class="mb-4">
              <label for="category_id" class="block text-gray-700">Category</label>
              <select name="category_id" id="category_id" class="border rounded w-full py-2 px-3 text-gray-700">
                  <option value="">-- Select Category --</option>
                  @foreach($categories as $category)
                      <option value="{{ $category->id }}" {{ $category->id == old('category_id', $task->category_id) ? 'selected' : '' }}>
                          {{ $category->category_name }}
                      </option>
                  @endforeach
              </select>
          </div>

          <!-- Status Dropdown -->
          <div class="mb-4">
              <label for="status_id" class="block text-gray-700">Status</label>
              <select name="status_id" id="status_id" class="border rounded w-full py-2 px-3 text-gray-700">
                  @foreach($statuses as $status)
                      <option value="{{ $status->id }}" 
                      {{ $status->id == old('status_id', $task->status_id) ? 'selected' : '' }}
                      {{ $task->status_id != 1 && $status->id == 1? 'disabled' : '' }}
                      {{ $task->status_id == 4 && $status->id != 4? 'disabled' : '' }}
                      >
                          {{ $status->status_name }}
                      </option>
                  @endforeach
              </select>
          </div>

          <!-- Submit Button -->
          <div class="flex items-center justify-between">
              <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">
                  Update Task
              </button>
          </div>
      </form>
    </div>
  </div>
</x-app-layout>